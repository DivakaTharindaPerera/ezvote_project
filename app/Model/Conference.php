<?php

require_once approot.'/libraries/php-jwt-master/src/JWT.php';
require_once approot.'/libraries/php-jwt-master/src/BeforeValidException.php';
require_once approot.'/libraries/php-jwt-master/src/ExpiredException.php';
require_once approot.'/libraries/php-jwt-master/src/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class Conference extends Model
{

    public function Attributes(): array
    {
        return [
            'ConferenceID' ,
            'ConferenceName',
            'ElectionID',
            'SupervisorID',
            'ConferenceLink',
            'ConferencePassword',
            'HostID',
            'DateAndTime',
        ];
    }

    public function tableName(): string
    {
        return 'conference';
    }

    private function createMeeting($data = array())
    {
        $post_time = $data['start_date'];
        $start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));


        $createMeetingArr = array();
        if (!empty($data['alternative_host_ids']))
        {
            if (count($data['alternative_host_ids']) > 1)
            {
                $alternative_host_ids = implode(",", $data['alternative_host_ids']);
            }
            else
            {
                $alternative_host_ids = $data['alternative_host_ids'][0];
            }
        }

        $createMeetingArr['topic'] = $data['topic'];
        $createMeetingArr['agenda'] = !empty($data['agenda']) ? $data['agenda'] : "";
        $createMeetingArr['type'] = !empty($data['type']) ? $data['type'] : 2; //Scheduled
        $createMeetingArr['start_time'] = $start_time;
        $createMeetingArr['timezone'] = 'Asia/Colombo';
        $createMeetingArr['password'] = !empty($data['password']) ? $data['password'] : "";
        $createMeetingArr['duration'] = !empty($data['duration']) ? $data['duration'] : 60;

        $createMeetingArr['settings'] = array(
            'join_before_host' => !empty($data['join_before_host']) ? true : false,
            'host_video' => !empty($data['option_host_video']) ? true : false,
            'participant_video' => !empty($data['option_participants_video']) ? true : false,
            'mute_upon_entry' => !empty($data['option_mute_participants']) ? true : false,
            'enforce_login' => !empty($data['option_enforce_login']) ? true : false,
            'auto_recording' => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        );

        $request_url = "https://api.zoom.us/v2/users/" . EMAIL_ID . "/meetings";
        $token = array(
            "iss" => API_KEY,
            "exp" => time() + 3600 //60 seconds as suggested

        );
        $getJWTKey = JWT::encode($token, API_SECRET);
        $headers = array(
            "authorization: Bearer " . $getJWTKey,
            "content-type: application/json",
            "Accept: application/json",
        );

        $fieldsArr = json_encode($createMeetingArr);
//        Remove \ from the $fieldsArr
        $fieldsArr = str_replace("\\", "", $fieldsArr);
//        print_r($fieldsArr);

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $request_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $fieldsArr,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$result)
        {
            return $err;
        }
        return json_decode($result);
    }

    public function addConference($data)
    {
        $data['type']='2';
        $data['option_enforce_login']=true;
        $msg=$this->createMeeting($data);
        $conferenceTopic=$msg->topic;
        $conferenceLink=$msg->join_url;
        $conferencePassword=openssl_encrypt($msg->password,ENCRYPTION_ALGORITHM,ENCRYPTION_KEY,0,ENCRYPTION_IV);
        $hostID=$msg->host_id;
        $sql= "INSERT INTO conferences (ConferenceID,ConferenceName, ElectionID, SupervisorID, ConferenceLink, ConferencePassword,HostID,DateAndTime) VALUES (:ConferenceID,:ConferenceName, :ElectionID, :SupervisorID, :ConferenceLink, :ConferencePassword,:HostID,:DateAndTime)";
        $this->db->query($sql);
        $this->db->bind(':ConferenceID',$data['conferenceID']);
        $this->db->bind(':ConferenceName',$conferenceTopic);
        $this->db->bind(':ElectionID',$data['electionId']);
        $this->db->bind(':SupervisorID',$data['supervisorId']);
        $this->db->bind(':ConferenceLink',$conferenceLink);
        $this->db->bind(':ConferencePassword',$conferencePassword);
        $this->db->bind(':HostID',$hostID);
        $this->db->bind(':DateAndTime',$data['start_date']);
        try{
            $this->db->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function AddCandidateToConference(string $conferenceID,array $candidates): bool
    {
        if (!empty($candidates)){
            foreach ($candidates as $candidate){
                $this->db->query("INSERT INTO conference_candidate (ConferenceID, CandidateID) VALUES (:ConferenceID, :CandidateID)");
                $this->db->bind(':ConferenceID',$conferenceID);
                $this->db->bind(':CandidateID',$candidate);
                try {
                    $this->db->execute();
                }catch (PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }
            return true;

        }else{
            return false;
        }
    }

    public function getConferencesByUserID($userID)
    {
        $this->db->query("SELECT * FROM Conferences WHERE SupervisorID = $userID");
        return $this->db->resultSet();
    }

    public function getCandidatesByConferenceId($conferenceID)
    {
        $this->db->query("SELECT candidateID FROM conference_candidate WHERE conferenceID = :ConferenceID");
        $this->db->bind(':ConferenceID',$conferenceID);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getConferencesByCandidateId($candidateid)
    {
        $this->db->query("SELECT * FROM conference INNER JOIN conference_candidate cc ON cc.conferenceID=conference.conferenceID WHERE cc.candidateID= :CandidateID");
        $this->db->bind(':CandidateID',$candidateid);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
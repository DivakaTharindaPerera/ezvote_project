let upload = document.getElementById('csvupload');
let output = document.getElementById('output');
let list = document.getElementById('list');
let form = document.getElementById('form');
var count = 0;
document.getElementById('count').innerHTML = count;

function check_for_duplicates(email){
    var rows = document.getElementById('list').getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        var tbrow = rows[i].getElementsByTagName('td');
        var tdemail = tbrow[1].innerHTML;
        if (tdemail == email) {
            return true;
        }
    }
}

function getData() {
    var data = [];
    var rows = document.getElementById('list').getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        var row = rows[i].getElementsByTagName('td');
        var name = row[0].innerHTML;
        var email = row[1].innerHTML;
        var value = row[2].innerHTML;
        data.push({ name, email, value });
    }
    console.log(data);
}

form.addEventListener('submit', (e) => {
    e.preventDefault();
    var count;
    // var data = [];
    var rows = document.getElementById('list').getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        var row = rows[i].getElementsByTagName('td');
        var name = row[0].innerHTML;
        var email = row[1].innerHTML;
        var value = row[2].innerHTML;
        const nameelement = document.createElement('input');
        nameelement.setAttribute('type', 'hidden');
        nameelement.setAttribute('name', i + 1 + 'name');
        nameelement.setAttribute('value', name);

        const emailelement = document.createElement('input');
        emailelement.setAttribute('type', 'hidden');
        emailelement.setAttribute('name', i + 1 + 'email');
        emailelement.setAttribute('value', email);

        const valueelement = document.createElement('input');
        valueelement.setAttribute('type', 'hidden');
        valueelement.setAttribute('name', i + 1 + 'value');
        valueelement.setAttribute('value', value);

        form.appendChild(nameelement);
        form.appendChild(emailelement);
        form.appendChild(valueelement);

        count = i + 1;
    }

    const countelement = document.createElement('input');
    countelement.setAttribute('type', 'hidden');
    countelement.setAttribute('name', 'count');
    countelement.setAttribute('value', count);
    form.appendChild(countelement);

    form.submit();

    // data = JSON.stringify(data);

    // fetch('addVoters.php', {
    //     method: 'POST',
    //     body: data
    // })

    // .then(res => res.json())
    // .then(data => {
    //     console.element(data);
    // })
    // .catch(err => {
    //     console.log(err);
    // })
})

upload.addEventListener('change', () => {

    let fr = new FileReader();
    fr.readAsText(upload.files[0]);
    fr.onload = function () {

        var lines = fr.result.split('\n');
        for (let i = 0; i < lines.length; i++) {
            

            var dataRow = lines[i].split('-');
            if(check_for_duplicates(dataRow[1])){
                const duplicate = document.createElement('span');
                duplicate.innerHTML = 'Duplicate email: ' + dataRow[1];
                const brk = document.createElement('br');
                document.getElementById('duplicateentries').appendChild(duplicate);
                document.getElementById('duplicateentries').appendChild(brk);
                continue;
            }
            count++;
            // console.log(lines[i]);
            const row = document.createElement('tr');
            row.setAttribute('id', count);

            const name = document.createElement('td');
            const email = document.createElement('td');
            const value = document.createElement('td');

            const del = document.createElement('button');
            del.setAttribute('onclick', 'del(this.id)');
            del.setAttribute('id', count);
            del.innerHTML = 'DELETE';

            name.innerHTML = dataRow[0];
            email.innerHTML = dataRow[1];
            value.innerHTML = dataRow[2];

            row.appendChild(name);
            row.appendChild(email);
            row.appendChild(value);
            row.appendChild(del);

            list.appendChild(row);
        }
        document.getElementById('count').innerHTML = count;
        if (count > 0) {
            document.getElementById('voterList').style.display = "block";
        }
    }
})

function del(id) {
    document.getElementById('list').removeChild(document.getElementById(id));
    count--;
    document.getElementById('count').innerHTML = count;
    if (count == 0) {
        document.getElementById('voterList').style.display = "none";
    }
    console.log('delete: ' + id);
}
function delall() {
    document.getElementById('list').innerHTML = "";
    count = 0;
    document.getElementById('count').innerHTML = count;
    document.getElementById('voterList').style.display = "none";
}

function addSingleVoter() {


    document.getElementById('nameerror').innerHTML = '';
    document.getElementById('emailerror').innerHTML = '';


    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var value = document.getElementById('value').value;

    if (name == '') {
        document.getElementById('nameerror').innerHTML = 'Name is required';
        document.getElementById('name').focus();
        return;
    }

    if (email == '') {
        document.getElementById('emailerror').innerHTML = 'Email is required';
        document.getElementById('email').focus();
        return;
    }

    if (value == '') {
        value = 1;
    }


    if(check_for_duplicates(email)){
        document.getElementById('emailerror').innerHTML = 'A voter with the same email ( ' + email + ' ) already exists';
        document.getElementById('email').focus();
        return;
    }
    

    count++;

    const row = document.createElement('tr');
    row.setAttribute('id', count);

    const nameelement = document.createElement('td');
    const emailelement = document.createElement('td');
    const valueelement = document.createElement('td');

    const del = document.createElement('button');
    del.setAttribute('onclick', 'del(this.id)');
    del.setAttribute('id', count);
    del.innerHTML = 'DELETE';

    nameelement.innerHTML = name;
    emailelement.innerHTML = email;
    valueelement.innerHTML = value;

    row.appendChild(nameelement);
    row.appendChild(emailelement);
    row.appendChild(valueelement);
    row.appendChild(del);

    list.appendChild(row);

    document.getElementById('count').innerHTML = count;
    if (count > 0) {
        document.getElementById('voterList').style.display = "block";
    }
}
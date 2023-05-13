// let candidateSelect = document.getElementsByName('candidate');
// let SelectedCandidateID = [];
// // Get the candidate select element all the options value
// let AllCandidateID = [];
// const candidateOptions = document.getElementById('SelectCandidate').options;
// for (let i = 0; i < candidateOptions.length; i++) {
//     AllCandidateID.push(candidateOptions[i].value);
// }
//
// const CreateInput = (value) => {
//     const input = document.createElement('input');
//     input.type = 'hidden';
//     input.name = 'candidate[]';
//     input.value = value;
//     return input;
// }
//
// if (candidateSelect) {
//     candidateSelect.forEach((select) => {
//         select.addEventListener('change', (e) => {
//             const Cdata = document.getElementById('Cdata');
//             if (e.target.value === 'all') {
//                 const table = document.getElementById('Ctable');
//                 const tablebody = table.querySelector('tbody');
//                 const rows = tablebody.querySelectorAll('tr');
//                 rows.forEach((row) => {
//                     row.classList.remove('none');
//                     Cdata.appendChild(CreateInput(row.id));
//                 })
//
//             }else if (e.target.value === 'some') {
//                 const table = document.getElementById('Ctable');
//                 const tablebody = table.querySelector('tbody');
//                 const rows = tablebody.querySelectorAll('tr');
//                 rows.forEach((row) => {
//                     row.classList.add('none');
//                 })
//                 Cdata.innerHTML = '';
//                 SelectedCandidateID.forEach((id) => {
//                     const row = table.querySelector(`tr[id="${id}"]`);
//                     row.classList.remove('none');
//                     Cdata.appendChild(CreateInput(row.id));
//                 })
//             }
//         });
//     });
// }
//
// const AddCandidate = ()=>{
//     const table = document.getElementById('Ctable');
//     const CandidateID = document.getElementById('SelectCandidate').value;
//     console.log(table);
// //     get table row that has the candidate id as id
//     const row = table.querySelector(`tr[id="${CandidateID}"]`);
//     SelectedCandidateID.push(CandidateID);
//     row.classList.remove('none');
//     const Cdata = document.getElementById('Cdata');
//     Cdata.appendChild(CreateInput(row.id));
// }
//
//
// document.querySelector('.select').onchange = function (e) {
//     let items = [];
//     for (var i= 0; i < e.currentTarget.options.length; i++) {
//         let opt = e.currentTarget.options[i];
//
//         if (opt.selected) {
//             items.push(opt.value);
//         }
//     }
//
//     // pass the selected items
//     return items;
// };
//  function showElections(){
//
//      const content=document.getElementById('dropdown-content');
//      console.log(content)
//      content.classList.remove('none')
//
//  }
console.log('hello')
 let candidatesParticipation=document.getElementById('candidates');
 let votersParticipation=document.getElementById('voters');
 let participation=[];
 if(candidatesParticipation.checked){
     if(votersParticipation.checked) {
         console.log('both');
     }
     else{
         console.log('candidates');
     }
 }
 else{
     if(votersParticipation.checked) {
         console.log('voters');
     }
     else{
         console.log('none');
     }
 }


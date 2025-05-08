import './bootstrap';

const teamMembers = document.getElementById('teamMembers');

teamMembers.childNodes.forEach((child) => {
    child.addEventListener('click', () => {
        console.log(child.dataset.id);
        axios.put('/group/changeTeamGids', { guest_id: child.dataset.id, team_id: teamMembers.dataset.id })
        .then(response => {
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    })
});
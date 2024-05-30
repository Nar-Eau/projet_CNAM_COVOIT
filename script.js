document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        row.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            fetch(`get_scores.php?id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    const scoresContainer = document.getElementById('scores-container');
                    scoresContainer.innerHTML = '';
                    if (data.length > 0) {
                        const table = document.createElement('table');
                        table.innerHTML = `
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                            ${data.map(score => `
                                <tr>
                                    <td>${score.module_name}</td>
                                    <td>${score.score}</td>
                                </tr>`).join('')}
                            </tbody>
                        `;
                        scoresContainer.appendChild(table);
                    } else {
                        scoresContainer.innerHTML = '<p>Aucun score trouvé pour cet utilisateur.</p>';
                    }
                });
        });
    });
});

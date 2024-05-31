function confirmDelete(){if(!confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?"))return!1;document.getElementById("deleteForm").submit()}window.onload=function(){let n=0;const t=document.querySelectorAll(".question-container"),r=document.getElementById("nextButton"),o=document.getElementById("submitButton"),l=document.getElementById("progress-bar");const c=100;let a=0,s,d=5;const i=()=>{if(100<=a){console.log(a),clearInterval(s);var e=document.querySelectorAll(".current .answer");if(0<e.length){const t=Math.floor(Math.random()*e.length);e.forEach(e=>{e=e.getElementsByTagName("input")[0];parseInt(e.getAttribute("data-index"))==t&&(e.checked=!0,document.getElementById("nextButton").click())})}a=0}else{e=c/(1e3*d)*100;100<a+e?a=100:a+=e,l.style.width=a+"%",d-=c/1e3}};function u(e){0<=e&&e<t.length&&(0<e&&(t[n].style.display="none"),t[e].style.display="block",n=e,(currentQuestion=t[n]).classList.add("current"),s&&clearInterval(s),a=0,s=setInterval(i,c),n===t.length-1)&&(r.style.display="none",o.style.display="block")}r.addEventListener("click",function(){let e=!1;for(const t of currentQuestion.querySelectorAll('input[type="radio"]'))if(t.checked){e=!0;break}e?(currentQuestion.classList.remove("current"),u(n+1),s=setInterval(i,c)):alert("Veuillez sélectionner une réponse avant de passer à la question suivante.")}),u(n),document.querySelectorAll(".answer label").forEach(e=>{var t=e.getElementsByTagName("input")[0];let n="";switch(parseInt(t.getAttribute("data-index"))){case 0:n="A";break;case 1:n="B";break;case 2:n="C";break;case 3:n="D"}t=n,e.style.setProperty("--before-content",`"${t}"`)})},document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll("tbody tr").forEach(e=>{e.addEventListener("click",function(){var e=this.getAttribute("data-id");fetch("get_scores.php?id="+e).then(e=>e.json()).then(e=>{var t,n=document.getElementById("scores-container");n.innerHTML="",0<e.length?((t=document.createElement("table")).innerHTML=`
                        <thead>
                            <tr>
                                <th>Module</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                        ${e.map(e=>`
                            <tr>
                                <td>${e.module_name}</td>
                                <td>${e.score}</td>
                            </tr>`).join("")}
                        </tbody>
                    `,n.appendChild(t)):n.innerHTML="<p>Aucun score trouvé pour cet utilisateur.</p>"})})})});
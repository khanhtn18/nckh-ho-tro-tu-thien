/* nav */
const appendNav = id => {
    let appendedTag = "appendedNav";
    if (document.getElementById(appendedTag) === null) {
    document.getElementById(id).innerHTML += `
    <ul class="navbar-nav bg-dcolor pl-5 m-0 hide-for-large" id=${appendedTag} 
        style="animation: appear 500ms">
        ${document.querySelector("#navbarSupportedContent ul").innerHTML}
    </ul>
    `;
    } else {document.getElementById(appendedTag).remove()}
};
const hideShow = id => {
    let obj = document.getElementById(id);
    if (obj.style.visibility === 'hidden' || obj.style.visibility === '') 
    {document.getElementById(id).style.visibility = 'visible';} 
    else {obj.style.visibility = 'hidden';}
};
/* footer */
window.onload = () => {
    document.getElementById('footer-nav').innerHTML = `
        ${document.querySelector("#navbarSupportedContent ul").innerHTML}`;
};
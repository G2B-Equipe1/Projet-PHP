function toggleDisplay(elmt)
{
    if(typeof elmt == "string")
        elmt = document.getElementById(elmt);
    if(elmt.style.display == "none")
        elmt.style.display = "";
    else
        elmt.style.display = "none";
}
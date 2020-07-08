function openEyes() {
    document.getElementById('closedEyeLeft').style.display = "none";
    document.getElementById('closedEyeLeftLid').style.display = "none";
    document.getElementById('closedEyeRight').style.display = "none";
    document.getElementById('closedEyeRightLid').style.display = "none";
    movePupilsToCenter();
}

function closeEyes() {
        document.getElementById('closedEyeLeft').style.display = 'block';
        document.getElementById('closedEyeLeftLid').style.display = "block";
        document.getElementById('closedEyeRight').style.display = "block";
        document.getElementById('closedEyeRightLid').style.display = "block";
        movePupilsToCenter();
}

let usr = document.getElementById("username");
usr.onkeyup = function() {
    if (usr.value.length < 12 && usr.value.length > 0) {
        movePupilsToBottomLeft();
    } else if (usr.value.length < 25 && usr.value.length >= 12) {
        movePupilsToBottomMiddle();
    } else if (usr.value.length >= 25) {
        movePupilsToBottomRight();
    } else {
        movePupilsToCenter();
    }
};

function movePupilsToBottomLeft() {
    document.getElementById("pupilLeft").setAttribute("cx", 778.5);
    document.getElementById("pupilLeft").setAttribute("cy", 366.5);
    document.getElementById("pupilRight").setAttribute("cx", 867.6);
    document.getElementById("pupilRight").setAttribute("cy", 366.5);
}

function movePupilsToBottomMiddle() {
    document.getElementById("pupilLeft").setAttribute("cx", 785.5);
    document.getElementById("pupilLeft").setAttribute("cy", 366.5);
    document.getElementById("pupilRight").setAttribute("cx", 874.6);
    document.getElementById("pupilRight").setAttribute("cy", 366.5);
}

function movePupilsToBottomRight() {
    document.getElementById("pupilLeft").setAttribute("cx", 798.5);
    document.getElementById("pupilLeft").setAttribute("cy", 366.5);
    document.getElementById("pupilRight").setAttribute("cx", 887.6);
    document.getElementById("pupilRight").setAttribute("cy", 366.5);
}

function movePupilsToCenter() {
    document.getElementById("pupilLeft").setAttribute("cx", 788.5);
    document.getElementById("pupilLeft").setAttribute("cy", 356.5);
    document.getElementById("pupilRight").setAttribute("cx", 877.6);
    document.getElementById("pupilRight").setAttribute("cy", 356.5);
}
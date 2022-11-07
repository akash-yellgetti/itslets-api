var baseURL = "";
var basePath = 'http://localhost:81/itslets';
if (baseURL == "") {
    getDocumentBasePath();
}

function getDocumentBasePath() {
    var documentBasePath = document.location.href;
    baseURL = documentBasePath.substring(0, documentBasePath.indexOf(basePath)) + basePath;
}
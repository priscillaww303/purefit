< script type = "text/javascript" >
    var myRegExp1 = /Tom|Jan|Alex/;
var string1 = "John went to the store and talked with Alexandra today.";
var matchPos1 = string1.search(myRegExp1);

if (matchPos1 != -1)
    document.write("The first string found a match at " + matchPos1);
else
    document.write("No match was found in the first string");

var myRegExp2 = /Tom|Jan|Alex /;
var string2 = "John went to the store and talked with Alexandra today.";
var matchPos2 = string2.search(myRegExp2);
if (matchPos2 != -1)
    document.write("<br />The second string found a match at " + matchPos2);
else
    document.write("<br />No match was found in the second string");

var myRegExp3 = /Tom|Jan|Alexandra/;
var string3 = "John went to the store and talked with Alexandra today.";
var matchPos3 = string3.search(myRegExp3);
if (matchPos3 != -1)
    document.write("<br />The third string found a match at " + matchPos3);
else
    document.write("<br />No match was found in the third string");

var myRegExp4 = /Tom|Jan|Alexandra/;
var string4 = "John went to the store and talked with Alex today.";
var matchPos4 = string4.search(myRegExp4);
if (matchPos4 != -1)
    document.write("<br />The fourth string found a match at " + matchPos4);
else
    document.write("<br />No match was found in the fourth string"); < /script>
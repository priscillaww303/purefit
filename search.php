<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
    </title>
</head>

<body>

    <div id="top_search">
        <form name="input" action="search_func.php" method="get" id="search_form">
            <input type="text" id="keywords" name="keywords" size="128" class="searchbox" value="$defaultText"> &nbsp;
            <select id="category" name="category" class="searchbox">
                "; createCategoryList(); echo '
            </select> &nbsp;
            <input type="submit" value="Search" class="button" /> &nbsp;
        </form>
    </div>
    ';

</body>

</html>
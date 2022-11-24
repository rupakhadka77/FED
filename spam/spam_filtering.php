<!DOCTYPE html>
<html>

<head>
    <title>spam</title>
</head>

<body>

    <?php require_once 'spamfilter.php';
    $text = "Do you want to purchase some vivaxa?";

    // Search in a specific blacklist (absolute paths can be used instead)
    $filter = new SpamFilter(['blacklists/blacklist-trading.txt']);
    $result = $filter->check_text($text);
    if ($result) {
        echo "You like talking about economics and trading, right? Go away!";
    }






    // Search in all available blacklists
    $filter = new SpamFilter();

    $result = $filter->check_text($text);
    if ($result) {
        // Result contains the matched word (not the matched regular expression)
        // In our example, $result will contain the value "Drugs".
        echo "There is a special place in hell reserved for people who talk about '$result' on my blog!";
    } else {

        echo "Your comment is clean from all known spam!";
    }
    ?>
</body>

</html>
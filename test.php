<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        
        function countTeams($skills, $minPlayers, $minLevel=0, $maxLevel=0) {
            $i = 0;
            $ln = count($skills);

            $number_of_players = 0;

            
            for($i=0;$i<$ln;$i++) {
                if($skills[$i] >= $minLevel && $skills[$i] <= $maxLevel) {
                    $number_of_players++;
                }
            }

            return floor($number_of_players / $minPlayers);
        
        }

        echo countTeams([1, 5], 1, 5, 7);
    ?>
</body>
</html>
<?php
    function printTournamentBrackets($numberOfTeams)
    {
        if($numberOfTeams !== 8 && $numberOfTeams !== 16)
        {
            echo("<div><p>obecnie wspierane jest tylko 8 lub 16 druzyn w turnieju</p><table>");
            return;
        }
        echo("<div><p>tytul: drabinka turniejowa</p><table>");
        for($i=1;$i<=$numberOfTeams;$i++)
        {
            echo("<tr id='$i'>");

            for($j=1;$j<=log($numberOfTeams,2)+1;$j++)
            {
                echo("<td id='$j'>");
            }

            echo("</tr>");
        }
        echo("</table></div>");
    }
?>

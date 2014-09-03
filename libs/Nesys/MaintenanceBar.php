<?php

/**
 * Maintenance DebugBar panel
 * @version API-5
 */
class MaintenanceBar extends Nette\Object implements Nette\Diagnostics\IBarPanel
{

    public function getTab()
    {
        return '<span title="Maintenance mode activated" style="font-weight: bold; color: purple">
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACkElEQVR4Xo1TbUhTXxg/qWW6mku2ULysEe5DRQa7oURu6cBs/TeDQHG4O4S5DebQCsFiSaBNjCCdf2z7EIaLgWS5KNyYWAhqH+YdFEopucK2udGwMd9mQpzOGUrZ5ugHh/O839/znOcCDIFAIOZyuSfB3jjQ0NCgGRsbm7Db7W+QnrPLK5fL701PT2+IRKJzybLNZvMTiOD3+38KhUL9tnk/Ogd3YjKNRuOrqampT0hm/plcXFxcHolEYCwWgyqVqmvHbrFYBqqrqxvTtvUfBoPhSnd3t6uzs3MQU94JZLPZx/C9srICNBpNLUmSJa2tre2oJWU0Gt1KoKtUKh+jYnYkpmOdx+OVeL1e6PP5YDAYxG1sYUZutzvGYrGKQBJk6HS64ebmZitmYjKZBkKhULxAIBCA4XAYzs7OQplM1gNSIEOr1T51OBxLy8vf4eKXz1CrVr+USCS9FEUN8fl8NZ4bSAGG5aFlZG5uHi7Mf4D/P7J6QVYWkSww7W8Dk8nMdTqdI6Ui4eXNjVUw4d0AHrbkuORGbwdy70tZgMPJzrPZbI6i02cuHOWwgcfjCbT0ubz0ez9gk1X1Fdcf9IG9kJ+fzx11jb5bXPwaH9TMzMwmQeRdQq4T2eI2n6CdhtTwN1iqbutKSCYIopCm6YVgMISfKT5ttECNv0d66Dyj4m4YF1E8D8ESqsWwq+fJycmPTU3XBvv7+9+i5YBSqTTxK5m5FxmV96NkBw3rhpZgUZWqCWDo9fqb6+vrEN13xsfH59AOPIsvUTJkca4y/uuJke1uSL2IQL64phYoFIpba2trEB+0oiOYFEiF7AJlTo0Vnr39evUI71QlNh0uKyvToV+6Hr8/+BewCuvSGQXlWPwFJ9Ag0TD+eV8AAAAASUVORK5CYII=">Maintenance mode</span>';
    }

    public function getPanel()
    {
	$tabulka = "<table>";
	$no = 0;
	foreach (\Nesys\NesysCore::$ServiceIPs as $ip) {
	    if ($_SERVER["REMOTE_ADDR"] == $ip)
		$tabulka .= "<tr><td><b>$no</b></td><td><b>$ip</b></td></tr>";
	    else 
		$tabulka .= "<tr><td>$no</td><td>$ip</td></tr>";
	    $no++;
	}
	$tabulka .= "</table>";
        return '<h1>Maintenance</h1><div class="nette-inner">Maintenance mode activated<br /><br /><b>Service IPs</b><br />'.$tabulka.'</div>';
    }

}

?>

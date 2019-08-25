<?php
function bucin()
{
    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,"http://222.124.10.204/kata.php");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"GET");

    $headers   = array();
    $headers[] = "Connection: keep-alive";
    $headers[] = "Cache-Control: max-age=0";
    $headers[] = "Upgrade-Insecure-Requests: 1";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36";
    $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
    $headers[] = "Accept-Encoding: gzip, deflate, br";

    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $bcin = curl_exec($ch);
    return $bcin;
}

function api()
{
    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,"http://52.36.169.120/uploads/api.php");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"GET");

    $headers   = array();
    $headers[] = "Connection: keep-alive";
    $headers[] = "Cache-Control: max-age=0";
    $headers[] = "Upgrade-Insecure-Requests: 1";
    $headers[] = "User-Agent: Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1";
    $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3";
    $headers[] = "Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";

    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $result = curl_exec($ch);
    return $result;
}

function regs()
{
    $regapi = json_decode(api());
    $fn     = $regapi->msg->first;
    $fl     = $regapi->msg->last;
    $pic    = $regapi->msg->picture;
    $a      = rand(0,999999999999);
    $aa     = "1009".$a."120028";
    $andro  = rand(0, 9999999);
    $d      = "ffffffff-fcff-3437-0000-0000".$andro."9";
    $bind   = '{"nickname":"'.$fn." ".$fl.'","avatar":"'.$pic.'","gender":1,"device_type":2,"device_code":"'.$d.'","third_platform":"GOOGLE","third_openid":"'.$aa.'"}';
    $ch     = curl_init();

    curl_setopt($ch,CURLOPT_URL,"https://api.mixit.fun/auth/login_by_social_account");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$bind);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_ENCODING,"gzip");

    $h   = array();
    $h[] = "Content-Type: application/json";

    curl_setopt($ch,CURLOPT_HTTPHEADER,$h);

    $result = curl_exec($ch);
    return $result;
}

function reff($reff)
{
    $tokenreff = json_decode(regs());
    $tkn       = $tokenreff->data->token;
    $body      = '{"share_code":"'.$reff.'"}';
    $ch        = curl_init();

    curl_setopt($ch,CURLOPT_URL,"https://api.mixit.fun/user/setFriendShareCode");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_ENCODING,"gzip");

    $h   = array();
    $h[] = "Content-Type: application/json";
    $h[] = "Authorization: ".$tkn."";
    $h[] = "User-Agent: MixFun/3.3.0(Android 23)";

    curl_setopt($ch,CURLOPT_HTTPHEADER,$h);
    $result = curl_exec($ch);
    return $result;
}

$bcin = bucin();
sleep(2);
echo "\x1b[1;36m[#INFO]\x1b[0m : Create by Charles Giovanni\n";
sleep(3);
echo "\x1b[1;36m[#INFO]\x1b[0m : Bot Invite MixFun\n";
sleep(4);
echo "\x1b[1;36m[#INFO]\x1b[0m : Made with \x1b[1;31m 💔 💔 💔 💔 💔\x1b[0m\n";
sleep(3);
echo "\033[1;33m[#QUOTE]: $bcin \033[0m\r\n\n";
sleep(2);

echo "Refferal : ";
$reff = trim(fgets(STDIN));

echo "Jumlah : ";
$jum = trim(fgets(STDIN));

echo "Delay : ";
$delay = trim(fgets(STDIN));

for ($a = 0; $a < $jum; $a++) {
    sleep($delay);
    $reslt     = reff($reff,$a,$delay);
    $tokenreff = json_decode(reff($reff));
    $tkn       = $tokenreff->msg;
    echo "SUCCESS | Respon : ".$tkn."\n";
}
?>

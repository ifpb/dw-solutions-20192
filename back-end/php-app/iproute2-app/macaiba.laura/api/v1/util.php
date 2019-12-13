<?php

function ps_encode($result)
{
  $ips = [];

  $regex = "/(\d+): (\S+):.*mtu (\d+).*state (\S+).*\s+link\/(\S+) (\S+) brd (\S+)/";
  preg_match_all($regex, $result, $matches);

  foreach ($matches[1] as $index => $user) {
    $ips[$matches[1][$index]] = [
      "id"    => $matches[1][$index],
      "name"     => $matches[2][$index],
      "mtu"     => $matches[3][$index],
      "state"     => $matches[4][$index],
      "link"     => $matches[5][$index],
      "mac"     => $matches[6][$index],
      "macbrd"     => $matches[7][$index],
    ];
  }

  $regex = "/(\d*).*\s+.*\s+inet (\d*.\d*.\d*.\d*)\/(\d)/";
  preg_match_all($regex, $result, $matches);

  foreach ($matches[1] as $index => $user) {
    $ips[$matches[1][$index]]["ip"] = $matches[2][$index];
    $ips[$matches[1][$index]]["ipmask"] = $matches[3][$index];
  }

  return  array_values($ips);
}

function encode_ps($result, $name)
{
  $ip = ["name" => $name];
  $ip["stats"] = [];
  $regex = "/(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/";
  preg_match_all($regex, $result, $matches);

  foreach ($matches[1] as $index => $user) {
    $ip["stats"]["rx"] = [
      "bytes"     => $matches[1][$index],
      "packets"   => $matches[2][$index],
      "errors"    => $matches[3][$index],
      "dropped"   => $matches[4][$index],
      "overrun"   => $matches[5][$index],
      "mcast"     => $matches[6][$index],
    ];
    $ip["stats"]["tx"] = [
      "bytes"     => $matches[1][$index],
      "packets"   => $matches[2][$index],
      "errors"    => $matches[3][$index],
      "dropped"   => $matches[4][$index],
      "overrun"   => $matches[5][$index],
      "mcast"     => $matches[6][$index],
    ];
  }
  return $ip;
}

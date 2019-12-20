<?php

function top_encode($result)
{
  $processes = [];

  $regex = "/(\d+): (\S+):.+mtu (\d+).+state (\w+) .+\s+link\/(\w+) (\S+) brd (\S+).+\s+inet (\d+\.\d+\.\d+\.\d+)\/(\d+)/";
  preg_match_all($regex, $result, $matches);

  foreach ($matches[2] as $index => $pid) {
    $processes[] = [
      "id"     => $matches[1][$index],
      "name"    => $matches[2][$index],
      "mtu"      => $matches[3][$index],
      "state"      => $matches[4][$index],
      "link"    => $matches[5][$index],
      "mac"     => $matches[6][$index],
      "macbrd"     => $matches[7][$index],
      "ip"       => $matches[8][$index],
      "ipmask"     => $matches[9][$index],
    ];
  }

  return $processes;
}

function encode_1($result) {
  $processos = [];
  $regex="/:\s+(.+):\s+.+\s+.+\s+RX: bytes  packets  errors  dropped overrun mcast\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+TX: bytes  packets  errors  dropped carrier collsns\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/";
  preg_match($regex,$result,$matches);
  $processos["name"]=$matches[1];
  $processos["stats"] = [];
  $processos["stats"]["rx"] = [
    "bytes" => $matches[2],
    "packets" => $matches[3],
    "errors" => $matches[4],
    "dropped" => $matches[5],
    "overrun" => $matches[6],
    "mcast" => $matches[7],
  ];
  $processos["stats"]["tx"] = [
    "bytes" => $matches[8],
    "packets" => $matches[9],
    "errors" => $matches[10],
    "dropped" => $matches[11],
    "overrun" => $matches[12],
    "mcast" => $matches[13],
  ];
  return $processos;
  
  
}
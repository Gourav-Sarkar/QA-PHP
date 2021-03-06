<?php
class strtoupper_filter
{
  function filter($in, $out, &$consumed, $closing)
  {
   while ($bucket = stream_bucket_make_writeable($in)) {
     $bucket->data = strtoupper($bucket->data);
     $consumed += $bucket->datalen;
     stream_bucket_append($out, $bucket);
   }
   return PSFS_PASS_ON;
  }
}
stream_filter_register("strtoupper", "strtoupper_filter");

$fp = fopen("php://output", "w");
stream_filter_append($fp, "strtoupper");

echo "echo: testing 123<br>";
print("print: testing 123<br>");
fwrite($fp, "fwrite: testing 123<br>");
?>
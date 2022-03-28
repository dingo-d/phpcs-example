<?php

echo 'Hello World'; // Bad.
echo 'Hello Denis'; // Ok.
echo 'Hello world'; // Bad.
echo 'Hello wOrlD'; // Bad.
echo 'Helloworld'; // Ok.

echo 'I said to all: hello world!'; // Bad.

// This is a comment with hello world. It shouldn't trigger a sniff.

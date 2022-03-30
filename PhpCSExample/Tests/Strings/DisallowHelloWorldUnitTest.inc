<?php

echo 'Hello World'; // Bad.
echo 'Hello Denis'; // Ok.
echo 'Hello world'; // Bad.
echo 'Hello wOrlD'; // Bad.
echo 'Helloworld'; // Ok.

echo 'I said to all: hello world!'; // Bad.

// This is a comment with hello world. It shouldn't trigger a sniff.

echo 'hello', 'world'; // Ok. https://3v4l.org/XbHjI
echo 'hello', ' world'; // Bad.

return 'hello WORLD'; // Bad.

function getHelloWorld() {
	return 'hello                                  world'; // Bad.
}

return 'hello



     
world'; // Bad.

'    Hello     world'; // Bad.

return 'hello


great
     
world'; // Ok.

echo "hello\nworld"; // Bad.

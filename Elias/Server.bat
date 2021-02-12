echo off
echo Enter:
echo wget 172.16.5.53:8000/text.txt
echo to allow access from linux

dir /W *.html > info.txt
dir /W *.php >> info.txt
dir /W *.js >> info.txt
dir /W *.css >> info.txt



python -m http.server
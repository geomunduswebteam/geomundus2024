# GeoMundus Conference 2024 - Website Repository
The GeoMundus Conference is a free international conference organized by students of the joint MSc program in Geospatial Technologies. Since 2009, the GeoMundus has been hosted annually alternating between the program’s organizing universities, NOVA IMS (Lisbon, Portugal), WWU (Münster, Germany) and UJI (Castellón de la Plana, Spain).

The conference brings together students, researchers, and professionals from the broader geospatial community for a unique collaborative experience. The aim is to share state of the art scientific research, knowledge, and skills in the fields of Geospatial Technologies, Geoinformatics, and Geosciences.

This repository contains all the code of the <a href = "https://geomundus.org/2024/"> website of the 16th GeoMundus Conference</a>, which will be hosted at IFGI by students of the M.Sc. in Geospatial Technologies on October 25th and 26th, 2024.

## 2024 Web Team

Chris Hubach,
Joseph Paintsil,
Rebeca Nunes Rodrigues,
Guilherme Viegas

Based on the work of previous editions.

--

The GeoMundus server is a GNU/Linux Ubuntu 24.04 LTS machine, which can be accessed following the steps bellow:

ssh geomundus@giv-hosting.uni-muenster.de
Enter the GeoMundus password

curl ifconfig.me
128.176.130.196

--

Regarding the Docker approach, we have tried to implement it in our current web server (VirtualMin), but it doesn't seem to work well with a microservices approach. Thus, in order not to take the risk of making our website unavailable at this particular sensitive moment, we decided to keep Docker only in the Stage environment for now, and document all the progress and knowledge we gather with these tools.

docker build -t my-php-app -f php.Dockerfile ..
docker run -d -p 81:80  -f php.Dockerfile ..

<?php
echo "IP do host.docker.internal: ";
echo gethostbyname('host.docker.internal');
echo "\n";

echo "IP do db: ";
echo gethostbyname('db');
echo "\n";

echo "Conteúdo de /etc/hosts:\n";
echo file_get_contents('/etc/hosts');


// docker-compose exec app php teste.php
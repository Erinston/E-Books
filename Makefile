conf:
	sudo apt-get install php7.2 php7.2-mbstring php7.2-mysql php7.2-intl php7.2-xml composer
	composer install --no-scripts
	cp .env.example .env
	php artisan key:generate
	sudo apt-get install mysql-server-5.7
	$(MAKE) bd-conf
	
composer:
	composer install --no-scripts
	cp .env.example .env
	php artisan key:generate
	$(MAKE) bd-conf

Windows:
	composer install --no-scripts
	copy .env.example .env
	php artisan key:generate
	sed -i 's/DB_DATABASE.*/DB_DATABASE=books/' .env
	sed -i 's/DB_USERNAME.*/DB_USERNAME=root/' .env
	sed -i 's/DB_PASSWORD.*/DB_PASSWORD=/' .env	

erinston:
	git config user.email "erinstong@gmail.com"
	git config user.name "Erinston"

bd-conf:
	mysql -u root -p --execute="drop database if exists books; create database books; drop user if exists 'books'; create user 'books' identified by 'books'; grant all privileges on books.* to 'books';"
	sed -i 's/DB_DATABASE.*/DB_DATABASE=books/' .env
	sed -i 's/DB_USERNAME.*/DB_USERNAME=books/' .env
	sed -i 's/DB_PASSWORD.*/DB_PASSWORD=books/' .env	
	php artisan migrate:refresh

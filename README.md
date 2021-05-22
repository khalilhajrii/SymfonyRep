Fist step switch repository from Main to Master
========================





Description
========================
this is aN e-COMMERCE project privde content creator's community with a unique and custom product provided by their favorite influencer

Installation process
========================
1. Clone or download repository

        git clone 'https://github.com/khalilhajrii/SymfonyRep.git'
   
2. Run composer


        composer install
   
3. Run installation script to create database and load fixtures

       php bin/console doctrine:database:create

       php bin/console doctrine:schema:update --force

       php bin/console doctrine:fixtures:load



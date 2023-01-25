### Prerequisites:

- `sudo apt update && sudo apt upgrade`
- `sudo apt-get install php`
- `sudo apt install composer`

How to install Deployer:

curl -LO [https://deployer.org/deployer.phar](https://deployer.org/deployer.phar) && sudo mv deployer.phar /usr/local/bin/dep && sudo chmod +x /usr/local/bin/dep

How to install this **Magento 2 recipe**:

composer require rafaelstz/deployer-magento2 --dev

Deployment:
dep deploy

or 
Run the Github action workflow
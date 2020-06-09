# Portfolio - Live Twitch

## Installation
```
git clone https://github.com/TBoileau/portfolio.git
cd portfolio
composer install
npm install
composer prepare
```

## Configuration
Créer un fichier `.env.local` : 
```dotenv
DATABASE_URL=mysql://root:password@127.0.0.1:3306/portfolio
```

## Démarer le serveur
```
symfony serve
npm run dev
```



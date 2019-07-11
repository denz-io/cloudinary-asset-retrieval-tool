# Cloudinary-Asset-Retrieval-Tool

I created this tool for a specific situation. Which is if you are using cloudinary as SAAS but previosly stored assets 
in server. Now this is no problem in general but if you decided to switch services and then you find out that you 
have hundereds of gigabityes of assets in server and not only that, there is no way for you to know which assets to upload 
to cloudinary or else risk redundant files (this is worst case scenario, if your db is fucked). If this is your situation then you're basically in hell so I made this.

# Dependencies

1. "php": ">=7.0.0",
2. "cloudinary/cloudinary_php": "^1.14",
3. "vlucas/phpdotenv": "^3.4"

# Setup

1. Run composer install to download dependencies.
2. Set up your credentials .env
3. Setup datapacket, this is just a JSON file. Unfotunately for now the way the data is read is 
specific to my situation and if you wan to use this you need to edit this part of the code. 

# ow to use

This has no CLI yet, maybe in the future ill add one. 

To create asset list 

1. Make sure that your data packet is set properly and that you are reading the correct data.
2. run php CreateAssetList.php.

To upload resources 

1. Make sure that the folder source of your assets is correct or else
   cloudinary will throw an error.
2. run php UploadAssets.php

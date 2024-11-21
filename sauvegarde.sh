#!/bin/bash

# Configuration
HOST="green_village-db-1"  # Utiliser le nom du conteneur comme hôte
PORT="3306"
USER="root"
PASSWORD="Afpa1234"
DATABASE="greenvillage"
BACKUP_DIR="/var/www/green_village/sauvegardes"
DATE=$(date +"%Y-%m-%d_%H-%M-%S")
BACKUP_FILE="$BACKUP_DIR/sauvegarde_$DATE.sql"

mkdir -p $BACKUP_DIR

mysqldump -h $HOST -P $PORT -u $USER -p$PASSWORD $DATABASE > $BACKUP_FILE 2>&1

if [ $? -eq 0 ]; then
    echo "Sauvegarde réussie : $BACKUP_FILE"
else
    echo "Erreur lors de la sauvegarde. Veuillez vérifier le fichier de log pour plus de détails."
    cat $BACKUP_FILE
    exit 1
fi

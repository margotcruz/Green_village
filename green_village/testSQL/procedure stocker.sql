SELECT 
    p.Id_produit, 
    p.libelle_court,
    p.marque,
    p.libelle_modele AS modele,
    t1.label_rubrique AS rubrique, 
    t2.label_rubrique AS sous_rubrique
FROM 
    rubrique AS t1
LEFT JOIN 
    rubrique AS t2 ON t2.Id_parent = t1.Id_rubrique
LEFT JOIN 
    produit AS p 
    ON p.Id_rubrique = COALESCE(t2.Id_rubrique, t1.Id_rubrique)
WHERE 
    t1.Id_parent IS NULL;


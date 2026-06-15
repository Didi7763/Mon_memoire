<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Utilisateur;
use App\Models\Fournisseur;
use App\Models\Categorie;
use App\Models\Actif;
use App\Models\Materiel;
use App\Models\Logiciel;
use App\Models\Donnee;
use App\Models\Employe;
use App\Models\Attribuer;
use App\Models\Maintenance;
use App\Models\Historique;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Création du Super Admin (celui qui a tous les accès)
        $admin = User::updateOrCreate(
            ['email' => 'admin@carena.ci'],
            [
                'name' => 'Super Admin',
                'NomCompUser' => 'ADMIN_001',
                'password' => Hash::make('Admin2024!'),
                'StatAdmin' => 'actif',
                'ListAccApp' => json_encode(['données', 'logiciels', 'matériels', 'catégories', 'employes', 'services', 'fournisseurs', 'attribution', 'maintenances', 'historiques', 'nouveau compte', 'tous comptes']),
                'ListPermApp' => json_encode(['create', 'edit', 'delete'])
            ]
        );

        // 2. Création d'un Utilisateur de base (pour les tests)
        $utilisateur = Utilisateur::updateOrCreate(
            ['CodeUser' => 'USER_TEST_001'],
            [
                'NomCompUser' => 'Jean Dupont',
                'ContactUser' => '0102030405',
                'EmailUser' => 'j.dupont@carena.ci'
            ]
        );

        // 3. Création d'un Service
        $service = Service::updateOrCreate(
            ['CodeUser' => 'USER_TEST_001', 'DesServ' => 'Informatique'],
            [
                'NpnomRespServ' => 'Marc Responsable'
            ]
        );

        // 4. Création d'un Employé lié
        $employe = Employe::updateOrCreate(
            ['CodeUser1' => 'USER_TEST_001', 'CodeUser' => 'USER_TEST_001'],
            [
                'FonctEmp' => 'Développeur',
                'StatEmp' => 'Actif',
                'ListActif' => 'PC-001',
            ]
        );

        // 5. Création des Fournisseurs
        Fournisseur::updateOrCreate(
            ['IdFour' => 'FOURN_001'],
            [
                'NomFour' => 'DELL Technologies',
                'ContFour' => '0505050505',
                'EmailFour' => 'contact@dell.com',
                'AdressFour' => 'Abidjan, Zone 3',
                'TypProdFournit' => 'Matériel Informatique',
                'NomPersCont' => 'M. DELL'
            ]
        );

        // Nouveaux fournisseurs de Matériel
        Fournisseur::updateOrCreate(['IdFour' => 'FOURN_HP'], [
            'NomFour' => 'HP Côte d\'Ivoire', 
            'ContFour' => '27220000', 
            'EmailFour' => 'sales@hp.ci', 
            'TypProdFournit' => 'Matériel Informatique (Serveurs/PC)'
        ]);
        Fournisseur::updateOrCreate(['IdFour' => 'FOURN_LENOVO'], [
            'NomFour' => 'Lenovo Enterprise', 
            'ContFour' => '27221122', 
            'EmailFour' => 'contact@lenovo.ci', 
            'TypProdFournit' => 'Matériel Informatique (Laptops)'
        ]);

        // Nouveaux fournisseurs de Logiciel
        Fournisseur::updateOrCreate(['IdFour' => 'FOURN_MS'], [
            'NomFour' => 'Microsoft France', 
            'ContFour' => '08009000', 
            'EmailFour' => 'licensing@microsoft.com', 
            'TypProdFournit' => 'Logiciels (Systèmes/Bureautique)'
        ]);
        Fournisseur::updateOrCreate(['IdFour' => 'FOURN_ADOBE'], [
            'NomFour' => 'Adobe Systems', 
            'ContFour' => '08001122', 
            'EmailFour' => 'support@adobe.com', 
            'TypProdFournit' => 'Logiciels (Design)'
        ]);

        // Nouveaux fournisseurs de Données/Cloud
        Fournisseur::updateOrCreate(['IdFour' => 'FOURN_AWS'], [
            'NomFour' => 'Amazon Web Services (AWS)', 
            'ContFour' => '08004455', 
            'EmailFour' => 'cloud-admin@amazon.com', 
            'TypProdFournit' => 'Hébergement de Données'
        ]);
        Fournisseur::updateOrCreate(['IdFour' => 'FOURN_GCLOUD'], [
            'NomFour' => 'Google Cloud Platform', 
            'ContFour' => '08006677', 
            'EmailFour' => 'gcp-support@google.com', 
            'TypProdFournit' => 'Services de Données & IA'
        ]);

        // 6. Création d'une Catégorie
        $categorie = Categorie::updateOrCreate(
            ['RefCatMat' => 'CAT_LAPTOP'],
            [
                'NomCatMat' => 'Ordinateurs Portables',
                'QteStockMat' => 10,
                'QteMinStockMat' => 2,
                'NoteCatMat' => 'Tout type de laptop'
            ]
        );

        // 7. CRÉATION DES ACTIFS (Matériel, Logiciel, Donnée)

        // A. Matériel
        $actifMat = Actif::firstOrCreate(
            ['IdAct' => 'MAT-001'],
            [
                'NomAct' => 'Dell Latitude 5420',
                'ComtAct' => 'PC de service standard',
                'type' => 'matériel'
            ]
        );
        Materiel::updateOrCreate(
            ['IdAct' => 'MAT-001'],
            [
                'MarqMat' => 'DELL',
                'ModMarq' => 'Latitude 5420',
                'NumSerieMat' => 'SN123456789',
                'DatAcqMat' => now(),
                'StatMat' => 'Neuf',
                'QteMat' => 1,
                'RefCatMat' => 'CAT_LAPTOP',
                'IdFour' => 'FOURN_001'
            ]
        );

        // B. Logiciel
        $actifLog = Actif::firstOrCreate(
            ['IdAct' => 'LOG-001'],
            [
                'NomAct' => 'Office 365 Business',
                'ComtAct' => 'Licence annuelle',
                'type' => 'logiciel'
            ]
        );
        Logiciel::updateOrCreate(
            ['IdAct' => 'LOG-001'],
            [
                'VersionLog' => '2024',
                'TypLicLog' => 'Abonnement',
                'NbrLicLog' => 50,
                'CleLicLog' => 'XXXXX-XXXXX-XXXXX',
                'DatAchLog' => now(),
                'IdFour' => 'FOURN_001'
            ]
        );

        // C. Donnée
        $actifDon = Actif::firstOrCreate(
            ['IdAct' => 'DON-001'],
            [
                'NomAct' => 'Base de données RH',
                'ComtAct' => 'Données critiques personnel',
                'type' => 'donnée'
            ]
        );
        Donnee::updateOrCreate(
            ['IdAct' => 'DON-001'],
            [
                'FormatData' => 'SQL',
                'SourceData' => 'Backup RH',
                'ResponsabeData' => 'DSI',
                'NivSensData' => 'Confidentiel',
                'StatData' => 'Actif',
                'DatRecpData' => now(),
                'DatMajData' => now(),
            ]
        );

        // 8. Une Attribution (Lier l'actif au user)
        Attribuer::updateOrCreate(
            ['IdAct' => 'MAT-001', 'CodeUser' => 'USER_TEST_001'],
            [
                'NumAdmin' => $admin->id,
                'DatAttAct' => now()
            ]
        );

        // 9. Une Maintenance
        Maintenance::updateOrCreate(
            ['IdAct' => 'MAT-001', 'TypMaint' => 'Préventive', 'DatMaint' => now()->format('Y-m-d')],
            [
                'DesMaint' => 'Nettoyage annuel',
                'CoutMaint' => 15000,
                'DatProchMaint' => now()->addMonths(6),
                'NomTechMaint' => 'Technicien Info',
                'ComtMaint' => 'Remplacement de la pâte thermique et dépoussiérage.'
            ]
        );

        // 10. Un Historique détaillé (Plusieurs entrées pour le test)
        Historique::updateOrCreate(
            ['IdAct' => 'MAT-001', 'DesAction' => 'Achat du matériel Laptop Dell auprès de DELL Technologies.'],
            ['DatAction' => now()->subDays(10)]
        );

        Historique::updateOrCreate(
            ['IdAct' => 'MAT-001', 'DesAction' => 'Attribution du matériel à l\'utilisateur Jean Dupont (DSI).'],
            ['DatAction' => now()->subDays(5)]
        );

        Historique::updateOrCreate(
            ['IdAct' => 'LOG-001', 'DesAction' => 'Mise à jour des licences Office 365 pour le département RH.'],
            ['DatAction' => now()->subDays(2)]
        );

        Historique::updateOrCreate(
            ['IdAct' => 'DON-001', 'DesAction' => 'Backup hebdomadaire de la base de données RH effectué avec succès.'],
            ['DatAction' => now()->subMinutes(30)]
        );
    }
}

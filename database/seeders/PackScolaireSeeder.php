<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PackScolaire;

class PackScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packs = [
            [
                'nom' => 'Pack Primaire Essentiel',
                'description' => 'Pack complet pour les élèves du primaire (CP à CM2). Contient toutes les fournitures de base nécessaires pour une année scolaire réussie.',
                'contenu' => "- 10 cahiers 96 pages grands carreaux\n- 5 cahiers 96 pages petits carreaux\n- 3 cahiers de brouillon\n- 10 stylos bleus\n- 5 stylos rouges\n- 3 crayons à papier HB\n- 2 gommes blanches\n- 1 règle 30cm\n- 1 équerre\n- 1 compas\n- 1 rapporteur\n- 1 trousse\n- 1 cartable",
                'prix' => 25000,
                'tag' => 'Populaire',
                'niveau_scolaire' => 'Primaire'
            ],
            [
                'nom' => 'Pack Collège Premium',
                'description' => 'Pack haut de gamme pour les collégiens (6ème à 3ème). Matériel de qualité supérieure pour accompagner les études secondaires.',
                'contenu' => "- 15 cahiers 96 pages grands carreaux\n- 10 cahiers 96 pages petits carreaux\n- 5 cahiers de brouillon\n- 15 stylos bleus\n- 10 stylos rouges\n- 5 stylos verts\n- 5 crayons à papier HB\n- 3 gommes blanches\n- 1 règle 30cm graduée\n- 1 équerre 60°\n- 1 compas de précision\n- 1 rapporteur 180°\n- 2 trousses\n- 1 sac à dos renforcé\n- 1 calculatrice scientifique",
                'prix' => 45000,
                'tag' => 'Premium',
                'niveau_scolaire' => 'Collège'
            ],
            [
                'nom' => 'Pack Lycée Scientifique',
                'description' => 'Pack spécialisé pour les lycéens en filière scientifique. Matériel adapté aux mathématiques, physique et chimie.',
                'contenu' => "- 20 cahiers 96 pages petits carreaux\n- 10 cahiers de brouillon\n- 20 stylos bleus\n- 10 stylos rouges\n- 5 stylos verts\n- 5 stylos noirs\n- 10 crayons à papier HB\n- 5 gommes blanches\n- 1 règle 30cm graduée\n- 1 équerre 45°\n- 1 compas de précision\n- 1 rapporteur 360°\n- 3 trousses\n- 1 sac à dos professionnel\n- 1 calculatrice graphique\n- 1 kit de géométrie avancé",
                'prix' => 65000,
                'tag' => 'Complet',
                'niveau_scolaire' => 'Lycée'
            ],
            [
                'nom' => 'Pack Maternelle Découverte',
                'description' => 'Pack adapté aux tout-petits pour découvrir le monde de l\'école. Matériel sécurisé et coloré.',
                'contenu' => "- 5 cahiers de coloriage\n- 3 cahiers d'écriture grands carreaux\n- 10 crayons de couleur\n- 5 feutres lavables\n- 3 crayons à papier gros diamètre\n- 2 gommes colorées\n- 1 règle 20cm\n- 1 trousse colorée\n- 1 petit sac à dos\n- 1 ardoise avec feutres\n- 1 boîte de pâte à modeler",
                'prix' => 15000,
                'tag' => 'Essentiel',
                'niveau_scolaire' => 'Maternelle'
            ],
            [
                'nom' => 'Pack Universitaire Pro',
                'description' => 'Pack professionnel pour étudiants universitaires. Matériel de qualité pour prendre des notes et organiser ses cours.',
                'contenu' => "- 10 cahiers 200 pages petits carreaux\n- 5 blocs-notes A4\n- 20 stylos bleus\n- 10 stylos rouges\n- 5 stylos noirs\n- 5 surligneurs couleurs\n- 5 crayons à papier\n- 3 gommes blanches\n- 1 règle 30cm\n- 1 perforatrice\n- 1 agrafeuse + agrafes\n- 2 classeurs A4\n- 1 sac ordinateur portable\n- 1 calculatrice scientifique",
                'prix' => 55000,
                'tag' => 'Premium',
                'niveau_scolaire' => 'Universitaire'
            ],
            [
                'nom' => 'Pack Économique CP-CE1',
                'description' => 'Pack économique pour les débutants en lecture et écriture. Rapport qualité-prix optimal.',
                'contenu' => "- 8 cahiers 96 pages grands carreaux\n- 3 cahiers de brouillon\n- 8 stylos bleus\n- 3 stylos rouges\n- 3 crayons à papier\n- 2 gommes\n- 1 règle 20cm\n- 1 trousse simple\n- 1 cartable basique",
                'prix' => 18000,
                'tag' => 'Économique',
                'niveau_scolaire' => 'CP'
            ]
        ];

        foreach ($packs as $pack) {
            PackScolaire::create($pack);
        }
    }
}

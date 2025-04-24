<?php
namespace Database\Seeders;

use App\Models\Avis;
use App\Models\Inscription;
use Illuminate\Database\Seeder;

class AvisSeeder extends Seeder
{
    public function run(): void
    {
        $inscriptions = Inscription::all();

       
        $comments = [
            "Cette plateforme a complètement transformé ma carrière. Les cours sont incroyablement bien structurés et les instructeurs sont des experts dans leur domaine.",
            "J'ai beaucoup appris grâce à cette formation. Les concepts sont clairs et les exercices sont très pratiques.",
            "Les cours sont détaillés et bien expliqués. Les formateurs répondent rapidement aux questions. Je recommande vivement !",
            "Une expérience d'apprentissage exceptionnelle ! J'ai pu améliorer mes compétences grâce à ces cours.",
            "La plateforme est intuitive et facile à utiliser. Les cours sont excellents et j'ai beaucoup progressé.",
            "Les cours sont très enrichissants. L'interaction avec les instructeurs est de qualité. Un excellent moyen d'apprendre.",
            "Je suis très satisfait de la plateforme. Les cours sont bien structurés et les évaluations sont stimulantes.",
            "Les formations sont d'une grande qualité. Elles m'ont permis de me perfectionner dans mon domaine.",
            "Excellente plateforme, les cours sont adaptés à tous les niveaux. Très bonne expérience !",
            "Les cours sont bien organisés et les exemples pratiques sont très utiles.",
            "Les formateurs sont toujours disponibles pour répondre à nos questions, ce qui est vraiment appréciable.",
            "La qualité des cours est incroyable. On apprend rapidement et efficacement.",
            "L'apprentissage est agréable et bien structuré. Je recommande vivement cette plateforme !",
            "Une excellente manière d'apprendre à son rythme avec des formateurs compétents.",
            "Les cours sont très bien détaillés, je suis content d'avoir choisi cette formation.",
            "J'ai pu appliquer ce que j'ai appris dans mes projets professionnels. Merci à la plateforme !",
            "Très bonne plateforme avec des cours variés. Les formateurs sont vraiment à l'écoute.",
            "Les cours sont pertinents et couvrent une large gamme de sujets. Je suis très satisfait.",
            "Un contenu de qualité et une plateforme très fluide. L'expérience d'apprentissage est top.",
            "C'est un excellent moyen d'apprendre de manière autonome, avec des ressources très complètes.",
            "J'ai trouvé les cours très enrichissants. C'est un bon investissement pour mon avenir professionnel.",
            "Les évaluations sont très bien pensées et m'aident à mieux comprendre les concepts.",
            "Une excellente plateforme pour développer ses compétences, avec une interface claire et agréable.",
            "Les vidéos sont de bonne qualité et les explications sont précises et faciles à suivre.",
            "Les cours sont complets et bien expliqués. J'ai appris énormément.",
            "L'accompagnement des formateurs est vraiment top. Ils sont toujours là pour aider.",
            "Je recommande cette plateforme à tous ceux qui veulent progresser dans leur domaine.",
            "Les exercices pratiques sont très utiles pour solidifier les connaissances acquises.",
            "La plateforme est bien conçue et facile à utiliser. Les cours sont très intéressants.",
            "Le contenu des cours est très détaillé et couvre bien les différents aspects du sujet.",
            "Les formations sont adaptées aux besoins des professionnels et permettent de se perfectionner rapidement.",
            "J'ai pu apprendre à mon rythme et approfondir mes connaissances grâce à cette plateforme.",
            "Les cours sont vraiment bien structurés et très pertinents pour mon développement personnel et professionnel."
        ];

        foreach ($inscriptions as $inscription) {
            $exists = Avis::where('etudiant_id', $inscription->etudiant_id)
                          ->where('cours_id', $inscription->cours_id)
                          ->exists();

            if (!$exists) {
                Avis::create([
                    'etudiant_id' => $inscription->etudiant_id,
                    'cours_id'    => $inscription->cours_id,
                    'note'        => rand(3, 5),
                    'commentaire' => $comments[array_rand($comments)], 
                ]);
            }
        }
    }
}

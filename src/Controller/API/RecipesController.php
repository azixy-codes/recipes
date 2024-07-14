<?php

namespace App\Controller\API;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class RecipesController extends AbstractController
{

    #[Route('/api/recipes')]
    public function index(RecipeRepository $recipeRepository, Request $request)
    {
        $page = $request->query->getInt('page', 1);
        $recipes = $recipeRepository->paginateRecipes($page);

        return $this->json($recipes, 200, [], [
            'groups' => ['recipes.index']
        ]);
    }

    #[Route('/api/recipes/{id}', requirements: ['id' => Requirement::DIGITS])]
    public function show(Recipe $recipe)
    {
        return $this->json($recipe, 200, [], [
            'groups' => ['recipes.index', 'recipes.show']
        ]);
    }

}

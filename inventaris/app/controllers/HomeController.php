<?php
class HomeController extends Controller {
    public function __construct() {
        $this->requireLogin();
    }

    public function index(): void {
        $category = $this->model('Category');
        $item = $this->model('Item');

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'categoryCount' => $category->count(),
            'itemCount' => $item->count(),
            'totalStock' => $item->totalStock(),
            'totalValue' => $item->totalValue(),
            'categorySummary' => $category->dashboardSummary()
        ]);
    }
}


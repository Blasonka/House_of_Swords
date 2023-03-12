<?php

namespace App\View\Components\introduction;

use Illuminate\View\Component;

class devCard extends Component
{
    /**
     * A fejlesztő neve.
     *
     * @var string
     */
    public $name;

    /**
     * A fejlesztő életkora.
     *
     * @var int
     */
    public $age;

    /**
     * A fejlesztő képének címe.
     *
     * @var string
     */
    public $imageUrl;

    /**
     * A fejlesztő szerepei - pl. backend fejlesztés és/vagy UI tervezés.
     *
     * @var string
     */
    public $roles;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $age, $imageUrl, $roles)
    {
        $this->name = $name;
        $this->age = $age;
        $this->imageUrl = $imageUrl;
        $this->roles = $roles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.introduction.dev-card');
    }
}

<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* zone_polluee/show.html.twig */
class __TwigTemplate_fd8c0944ebe2fbddb27e66b06b3688ff extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "zone_polluee/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "zone_polluee/show.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Détails de la zone";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container-fluid py-4\">
    <div class=\"row justify-content-center\">
        <div class=\"col-md-8\">
            <!-- Breadcrumb -->
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\"><a href=\"#\" class=\"text-decoration-none\">Dashboard</a></li>
                    <li class=\"breadcrumb-item\"><a href=\"";
        // line 13
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_index");
        yield "\" class=\"text-decoration-none\">Zones Polluées</a></li>
                    <li class=\"breadcrumb-item active\">Détails</li>
                </ol>
            </nav>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <h4 class=\"mb-0\">";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 22, $this->source); })()), "nomZone", [], "any", false, false, false, 22), "html", null, true);
        yield "</h4>
                        <span class=\"badge bg-";
        // line 23
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 23, $this->source); })()), "niveauPollution", [], "any", false, false, false, 23) <= 3)) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 23, $this->source); })()), "niveauPollution", [], "any", false, false, false, 23) <= 6)) ? ("warning") : ("danger"))));
        yield " fs-6\">
                            Niveau ";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 24, $this->source); })()), "niveauPollution", [], "any", false, false, false, 24), "html", null, true);
        yield "/10
                        </span>
                    </div>
                </div>
                
                <div class=\"card-body p-4\">
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"mb-4\">
                                <h6 class=\"text-muted mb-2\">Coordonnées GPS</h6>
                                <p class=\"fs-5\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 34, $this->source); })()), "coordonneesGps", [], "any", false, false, false, 34), "html", null, true);
        yield "</p>
                            </div>
                        </div>
                    </div>
                    
                    ";
        // line 39
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 39, $this->source); })()), "indicateur", [], "any", false, false, false, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 40
            yield "                        <div class=\"mt-4\">
                            <h5 class=\"mb-3\">Indicateur associé</h5>
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"row g-4\">
                                    <div class=\"col-md-4\">
                                        <div class=\"d-flex align-items-center\">
                                            <div class=\"flex-shrink-0\">
                                                <div class=\"bg-success bg-opacity-10 p-2 rounded-3\">
                                                    <i class=\"fas fa-trash-alt text-success\"></i>
                                                </div>
                                            </div>
                                            <div class=\"flex-grow-1 ms-3\">
                                                <small class=\"text-muted d-block\">Déchets récoltés</small>
                                                <span class=\"fw-bold\">";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 53, $this->source); })()), "indicateur", [], "any", false, false, false, 53), "totalKgRecoltes", [], "any", false, false, false, 53), "html", null, true);
            yield " kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"col-md-4\">
                                        <div class=\"d-flex align-items-center\">
                                            <div class=\"flex-shrink-0\">
                                                <div class=\"bg-info bg-opacity-10 p-2 rounded-3\">
                                                    <i class=\"fas fa-cloud text-info\"></i>
                                                </div>
                                            </div>
                                            <div class=\"flex-grow-1 ms-3\">
                                                <small class=\"text-muted d-block\">CO2 évité</small>
                                                <span class=\"fw-bold\">";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 66, $this->source); })()), "indicateur", [], "any", false, false, false, 66), "co2Evite", [], "any", false, false, false, 66), "html", null, true);
            yield " kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"col-md-4\">
                                        <div class=\"d-flex align-items-center\">
                                            <div class=\"flex-shrink-0\">
                                                <div class=\"bg-warning bg-opacity-10 p-2 rounded-3\">
                                                    <i class=\"fas fa-calendar text-warning\"></i>
                                                </div>
                                            </div>
                                            <div class=\"flex-grow-1 ms-3\">
                                                <small class=\"text-muted d-block\">Date de calcul</small>
                                                <span class=\"fw-bold\">";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 79, $this->source); })()), "indicateur", [], "any", false, false, false, 79), "dateCalcul", [], "any", false, false, false, 79), "d/m/Y H:i"), "html", null, true);
            yield "</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
        } else {
            // line 87
            yield "                        <div class=\"text-center py-5\">
                            <i class=\"fas fa-chart-line fs-1 text-muted mb-3\"></i>
                            <p class=\"text-muted\">Aucun indicateur associé à cette zone</p>
                        </div>
                    ";
        }
        // line 92
        yield "                </div>
                
                <div class=\"card-footer bg-white border-0 pb-4 px-4\">
                    <div class=\"d-flex gap-2\">
                        <a href=\"";
        // line 96
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_index");
        yield "\" class=\"btn btn-light\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Retour
                        </a>
                        <a href=\"";
        // line 99
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 99, $this->source); })()), "id", [], "any", false, false, false, 99)]), "html", null, true);
        yield "\" class=\"btn btn-warning\">
                            <i class=\"fas fa-edit me-2\"></i>Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "zone_polluee/show.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  229 => 99,  223 => 96,  217 => 92,  210 => 87,  199 => 79,  183 => 66,  167 => 53,  152 => 40,  150 => 39,  142 => 34,  129 => 24,  125 => 23,  121 => 22,  109 => 13,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Détails de la zone{% endblock %}

{% block body %}
<div class=\"container-fluid py-4\">
    <div class=\"row justify-content-center\">
        <div class=\"col-md-8\">
            <!-- Breadcrumb -->
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\"><a href=\"#\" class=\"text-decoration-none\">Dashboard</a></li>
                    <li class=\"breadcrumb-item\"><a href=\"{{ path('app_zone_polluee_index') }}\" class=\"text-decoration-none\">Zones Polluées</a></li>
                    <li class=\"breadcrumb-item active\">Détails</li>
                </ol>
            </nav>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <h4 class=\"mb-0\">{{ zone.nomZone }}</h4>
                        <span class=\"badge bg-{{ zone.niveauPollution <= 3 ? 'success' : (zone.niveauPollution <= 6 ? 'warning' : 'danger') }} fs-6\">
                            Niveau {{ zone.niveauPollution }}/10
                        </span>
                    </div>
                </div>
                
                <div class=\"card-body p-4\">
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"mb-4\">
                                <h6 class=\"text-muted mb-2\">Coordonnées GPS</h6>
                                <p class=\"fs-5\">{{ zone.coordonneesGps }}</p>
                            </div>
                        </div>
                    </div>
                    
                    {% if zone.indicateur %}
                        <div class=\"mt-4\">
                            <h5 class=\"mb-3\">Indicateur associé</h5>
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"row g-4\">
                                    <div class=\"col-md-4\">
                                        <div class=\"d-flex align-items-center\">
                                            <div class=\"flex-shrink-0\">
                                                <div class=\"bg-success bg-opacity-10 p-2 rounded-3\">
                                                    <i class=\"fas fa-trash-alt text-success\"></i>
                                                </div>
                                            </div>
                                            <div class=\"flex-grow-1 ms-3\">
                                                <small class=\"text-muted d-block\">Déchets récoltés</small>
                                                <span class=\"fw-bold\">{{ zone.indicateur.totalKgRecoltes }} kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"col-md-4\">
                                        <div class=\"d-flex align-items-center\">
                                            <div class=\"flex-shrink-0\">
                                                <div class=\"bg-info bg-opacity-10 p-2 rounded-3\">
                                                    <i class=\"fas fa-cloud text-info\"></i>
                                                </div>
                                            </div>
                                            <div class=\"flex-grow-1 ms-3\">
                                                <small class=\"text-muted d-block\">CO2 évité</small>
                                                <span class=\"fw-bold\">{{ zone.indicateur.co2Evite }} kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"col-md-4\">
                                        <div class=\"d-flex align-items-center\">
                                            <div class=\"flex-shrink-0\">
                                                <div class=\"bg-warning bg-opacity-10 p-2 rounded-3\">
                                                    <i class=\"fas fa-calendar text-warning\"></i>
                                                </div>
                                            </div>
                                            <div class=\"flex-grow-1 ms-3\">
                                                <small class=\"text-muted d-block\">Date de calcul</small>
                                                <span class=\"fw-bold\">{{ zone.indicateur.dateCalcul|date('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {% else %}
                        <div class=\"text-center py-5\">
                            <i class=\"fas fa-chart-line fs-1 text-muted mb-3\"></i>
                            <p class=\"text-muted\">Aucun indicateur associé à cette zone</p>
                        </div>
                    {% endif %}
                </div>
                
                <div class=\"card-footer bg-white border-0 pb-4 px-4\">
                    <div class=\"d-flex gap-2\">
                        <a href=\"{{ path('app_zone_polluee_index') }}\" class=\"btn btn-light\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Retour
                        </a>
                        <a href=\"{{ path('app_zone_polluee_edit', {'id': zone.id}) }}\" class=\"btn btn-warning\">
                            <i class=\"fas fa-edit me-2\"></i>Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}", "zone_polluee/show.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\zone_polluee\\show.html.twig");
    }
}

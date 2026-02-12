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

/* indicateur_impact/show.html.twig */
class __TwigTemplate_5d2d5e61204115909e6cdecd219656d8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "indicateur_impact/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "indicateur_impact/show.html.twig"));

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

        yield "Détails de l'indicateur";
        
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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_index");
        yield "\" class=\"text-decoration-none\">Indicateurs</a></li>
                    <li class=\"breadcrumb-item active\">Détails</li>
                </ol>
            </nav>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <h4 class=\"mb-0\">Indicateur d'Impact #";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 21, $this->source); })()), "id", [], "any", false, false, false, 21), "html", null, true);
        yield "</h4>
                </div>
                
                <div class=\"card-body p-4\">
                    <div class=\"row g-4\">
                        <div class=\"col-md-6\">
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"d-flex align-items-center mb-3\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-success bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-trash-alt text-success fs-4\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <small class=\"text-muted d-block\">Total déchets récoltés</small>
                                        <span class=\"h4 mb-0 fw-bold\">";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 36, $this->source); })()), "totalKgRecoltes", [], "any", false, false, false, 36), "html", null, true);
        yield " kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"d-flex align-items-center mb-3\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-info bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-cloud text-info fs-4\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <small class=\"text-muted d-block\">CO2 évité</small>
                                        <span class=\"h4 mb-0 fw-bold\">";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 51, $this->source); })()), "co2Evite", [], "any", false, false, false, 51), "html", null, true);
        yield " kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class=\"row mt-4\">
                        <div class=\"col-12\">
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"d-flex align-items-center\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-warning bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-calendar text-warning fs-4\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <small class=\"text-muted d-block\">Date de calcul</small>
                                        <span class=\"h4 mb-0 fw-bold\">";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 69, $this->source); })()), "dateCalcul", [], "any", false, false, false, 69), "d/m/Y H:i"), "html", null, true);
        yield "</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class=\"my-4\">
                    
                    <div class=\"row\">
                        <div class=\"col-12\">
                            <h5 class=\"mb-3\">Zones polluées associées</h5>
                            ";
        // line 81
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 81, $this->source); })()), "zonePolluees", [], "any", false, false, false, 81))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 82
            yield "                                <div class=\"table-responsive\">
                                    <table class=\"table table-hover align-middle\">
                                        <thead class=\"table-light\">
                                            <tr>
                                                <th>Zone</th>
                                                <th>Coordonnées</th>
                                                <th>Niveau</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ";
            // line 93
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 93, $this->source); })()), "zonePolluees", [], "any", false, false, false, 93));
            foreach ($context['_seq'] as $context["_key"] => $context["zone"]) {
                // line 94
                yield "                                            <tr>
                                                <td>";
                // line 95
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "nomZone", [], "any", false, false, false, 95), "html", null, true);
                yield "</td>
                                                <td>";
                // line 96
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "coordonneesGps", [], "any", false, false, false, 96), "html", null, true);
                yield "</td>
                                                <td>
                                                    <span class=\"badge bg-";
                // line 98
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "niveauPollution", [], "any", false, false, false, 98) <= 3)) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "niveauPollution", [], "any", false, false, false, 98) <= 6)) ? ("warning") : ("danger"))));
                yield "\">
                                                        ";
                // line 99
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "niveauPollution", [], "any", false, false, false, 99), "html", null, true);
                yield "/10
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href=\"";
                // line 103
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "id", [], "any", false, false, false, 103)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-light\">
                                                        <i class=\"fas fa-eye\"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['zone'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            yield "                                        </tbody>
                                    </table>
                                </div>
                            ";
        } else {
            // line 113
            yield "                                <div class=\"text-center py-4\">
                                    <i class=\"fas fa-map-marker-alt fs-1 text-muted mb-3\"></i>
                                    <p class=\"text-muted\">Aucune zone polluée associée à cet indicateur</p>
                                </div>
                            ";
        }
        // line 118
        yield "                        </div>
                    </div>
                </div>
                
                <div class=\"card-footer bg-white border-0 pb-4 px-4\">
                    <div class=\"d-flex gap-2\">
                        <a href=\"";
        // line 124
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_index");
        yield "\" class=\"btn btn-light\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Retour
                        </a>
                        <a href=\"";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 127, $this->source); })()), "id", [], "any", false, false, false, 127)]), "html", null, true);
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
        return "indicateur_impact/show.html.twig";
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
        return array (  273 => 127,  267 => 124,  259 => 118,  252 => 113,  246 => 109,  234 => 103,  227 => 99,  223 => 98,  218 => 96,  214 => 95,  211 => 94,  207 => 93,  194 => 82,  192 => 81,  177 => 69,  156 => 51,  138 => 36,  120 => 21,  109 => 13,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Détails de l'indicateur{% endblock %}

{% block body %}
<div class=\"container-fluid py-4\">
    <div class=\"row justify-content-center\">
        <div class=\"col-md-8\">
            <!-- Breadcrumb -->
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\"><a href=\"#\" class=\"text-decoration-none\">Dashboard</a></li>
                    <li class=\"breadcrumb-item\"><a href=\"{{ path('app_indicateur_impact_index') }}\" class=\"text-decoration-none\">Indicateurs</a></li>
                    <li class=\"breadcrumb-item active\">Détails</li>
                </ol>
            </nav>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <h4 class=\"mb-0\">Indicateur d'Impact #{{ indicateur.id }}</h4>
                </div>
                
                <div class=\"card-body p-4\">
                    <div class=\"row g-4\">
                        <div class=\"col-md-6\">
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"d-flex align-items-center mb-3\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-success bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-trash-alt text-success fs-4\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <small class=\"text-muted d-block\">Total déchets récoltés</small>
                                        <span class=\"h4 mb-0 fw-bold\">{{ indicateur.totalKgRecoltes }} kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"d-flex align-items-center mb-3\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-info bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-cloud text-info fs-4\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <small class=\"text-muted d-block\">CO2 évité</small>
                                        <span class=\"h4 mb-0 fw-bold\">{{ indicateur.co2Evite }} kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class=\"row mt-4\">
                        <div class=\"col-12\">
                            <div class=\"bg-light p-4 rounded-3\">
                                <div class=\"d-flex align-items-center\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-warning bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-calendar text-warning fs-4\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <small class=\"text-muted d-block\">Date de calcul</small>
                                        <span class=\"h4 mb-0 fw-bold\">{{ indicateur.dateCalcul|date('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class=\"my-4\">
                    
                    <div class=\"row\">
                        <div class=\"col-12\">
                            <h5 class=\"mb-3\">Zones polluées associées</h5>
                            {% if indicateur.zonePolluees is not empty %}
                                <div class=\"table-responsive\">
                                    <table class=\"table table-hover align-middle\">
                                        <thead class=\"table-light\">
                                            <tr>
                                                <th>Zone</th>
                                                <th>Coordonnées</th>
                                                <th>Niveau</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {% for zone in indicateur.zonePolluees %}
                                            <tr>
                                                <td>{{ zone.nomZone }}</td>
                                                <td>{{ zone.coordonneesGps }}</td>
                                                <td>
                                                    <span class=\"badge bg-{{ zone.niveauPollution <= 3 ? 'success' : (zone.niveauPollution <= 6 ? 'warning' : 'danger') }}\">
                                                        {{ zone.niveauPollution }}/10
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href=\"{{ path('app_zone_polluee_show', {'id': zone.id}) }}\" class=\"btn btn-sm btn-light\">
                                                        <i class=\"fas fa-eye\"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            {% endfor %}
                                        </tbody>
                                    </table>
                                </div>
                            {% else %}
                                <div class=\"text-center py-4\">
                                    <i class=\"fas fa-map-marker-alt fs-1 text-muted mb-3\"></i>
                                    <p class=\"text-muted\">Aucune zone polluée associée à cet indicateur</p>
                                </div>
                            {% endif %}
                        </div>
                    </div>
                </div>
                
                <div class=\"card-footer bg-white border-0 pb-4 px-4\">
                    <div class=\"d-flex gap-2\">
                        <a href=\"{{ path('app_indicateur_impact_index') }}\" class=\"btn btn-light\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Retour
                        </a>
                        <a href=\"{{ path('app_indicateur_impact_edit', {'id': indicateur.id}) }}\" class=\"btn btn-warning\">
                            <i class=\"fas fa-edit me-2\"></i>Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}", "indicateur_impact/show.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\indicateur_impact\\show.html.twig");
    }
}

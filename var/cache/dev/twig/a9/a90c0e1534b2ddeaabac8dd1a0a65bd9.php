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

/* zone_polluee/index.html.twig */
class __TwigTemplate_8d9287a4d44b72e75bb54fdbf8aac53c extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "zone_polluee/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "zone_polluee/index.html.twig"));

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

        yield "Gestion des Zones Polluées";
        
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
    <div class=\"row\">
        <div class=\"col-12\">
            <!-- Breadcrumb -->
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\">
                        <a href=\"#\" class=\"text-decoration-none\">Dashboard</a>
                    </li>
                    <li class=\"breadcrumb-item active\">Zones Polluées</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class=\"d-flex justify-content-between align-items-center mb-4\">
                <h2 class=\"h3 mb-0\">Gestion des Zones Polluées</h2>
            </div>

            <!-- STATS CARDS -->
            <div class=\"row g-3 mb-4\">
                <!-- Nouvelle Zone -->
                <div class=\"col-md-4\">
                    <a href=\"";
        // line 28
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_new");
        yield "\" class=\"text-decoration-none\">
                        <div class=\"card border-0 shadow-sm h-100\">
                            <div class=\"card-body\">
                                <div class=\"d-flex align-items-center\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-primary bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-plus-circle text-primary fs-3\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <h6 class=\"text-muted mb-1\">Nouvelle Zone</h6>
                                        <h3 class=\"mb-0 fw-bold\">";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("nouvelles_zones", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["nouvelles_zones"]) || array_key_exists("nouvelles_zones", $context) ? $context["nouvelles_zones"] : (function () { throw new RuntimeError('Variable "nouvelles_zones" does not exist.', 39, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Total Zones -->
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm h-100\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-info bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-map-marker-alt text-info fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total Zones</h6>
                                    <h3 class=\"mb-0 fw-bold\">";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("total_zones", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["total_zones"]) || array_key_exists("total_zones", $context) ? $context["total_zones"] : (function () { throw new RuntimeError('Variable "total_zones" does not exist.', 59, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Haut Risque -->
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm h-100\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-danger bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-exclamation-triangle text-danger fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Haut Risque</h6>
                                    <h3 class=\"mb-0 fw-bold text-danger\">";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("haut_risque", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["haut_risque"]) || array_key_exists("haut_risque", $context) ? $context["haut_risque"] : (function () { throw new RuntimeError('Variable "haut_risque" does not exist.', 78, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <div class=\"d-flex flex-wrap align-items-center justify-content-between\">
                        <div>
                            <h5 class=\"mb-1\">Liste des Zones Polluées</h5>
                            <p class=\"text-muted small mb-0\">Gérez et surveillez les zones à risque environnemental</p>
                        </div>
                        <a href=\"";
        // line 94
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_new");
        yield "\" class=\"btn btn-primary mt-2 mt-sm-0\">
                            <i class=\"fas fa-plus me-2\"></i>Nouvelle Zone
                        </a>
                    </div>
                </div>
                
                <div class=\"card-body p-4\">
                    <!-- Search and Filter -->
                    <form method=\"get\" action=\"";
        // line 102
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_index");
        yield "\" class=\"d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4\">
                        <div class=\"d-flex gap-2\">
                            <div class=\"position-relative\">
                                <i class=\"fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary\"></i>
                                <input type=\"text\" name=\"search\" class=\"form-control ps-5\" style=\"width: 250px;\" placeholder=\"Rechercher une zone...\" value=\"";
        // line 106
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("search", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 106, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\">
                            </div>
                            <button type=\"submit\" class=\"btn btn-light\">
                                <i class=\"fas fa-filter me-2\"></i>Filtrer
                            </button>
                        </div>
                    </form>

                    <!-- Table with DELETE BUTTON -->
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover align-middle\">
                            <thead class=\"table-light\">
                                <tr>
                                    <th>Zone</th>
                                    <th>Localisation</th>
                                    <th>Niveau de risque</th>
                                    <th>Date d'identification</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ";
        // line 128
        if ((array_key_exists("zones", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["zones"]) || array_key_exists("zones", $context) ? $context["zones"] : (function () { throw new RuntimeError('Variable "zones" does not exist.', 128, $this->source); })())) > 0))) {
            // line 129
            yield "                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["zones"]) || array_key_exists("zones", $context) ? $context["zones"] : (function () { throw new RuntimeError('Variable "zones" does not exist.', 129, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["zone"]) {
                // line 130
                yield "                                    <tr>
                                        <td>";
                // line 131
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "nomZone", [], "any", false, false, false, 131), "html", null, true);
                yield "</td>
                                        <td>";
                // line 132
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "coordonneesGps", [], "any", false, false, false, 132), "html", null, true);
                yield "</td>
                                        <td>
                                            <span class=\"badge bg-";
                // line 134
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "niveauPollution", [], "any", false, false, false, 134) <= 3)) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "niveauPollution", [], "any", false, false, false, 134) <= 6)) ? ("warning") : ("danger"))));
                yield "\">
                                                ";
                // line 135
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "niveauPollution", [], "any", false, false, false, 135), "html", null, true);
                yield "/10
                                            </span>
                                        </td>
                                        <td>";
                // line 138
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "dateIdentification", [], "any", false, false, false, 138), "d/m/Y"), "html", null, true);
                yield "</td>
                                        <td>
                                            <span class=\"badge bg-success\">Actif</span>
                                        </td>
                                        <td>
                                            <div class=\"d-flex gap-2\">
                                                <a href=\"";
                // line 144
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "id", [], "any", false, false, false, 144)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-light\">
                                                    <i class=\"fas fa-eye\"></i>
                                                </a>
                                                <a href=\"";
                // line 147
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "id", [], "any", false, false, false, 147)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-light\">
                                                    <i class=\"fas fa-edit\"></i>
                                                </a>
                                                <form method=\"post\" action=\"";
                // line 150
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "id", [], "any", false, false, false, 150)]), "html", null, true);
                yield "\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cette zone ?');\" style=\"display: inline-block;\">
                                                    <input type=\"hidden\" name=\"_token\" value=\"";
                // line 151
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "id", [], "any", false, false, false, 151))), "html", null, true);
                yield "\">
                                                    <button type=\"submit\" class=\"btn btn-sm btn-light text-danger\">
                                                        <i class=\"fas fa-trash\"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['zone'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 160
            yield "                                ";
        } else {
            // line 161
            yield "                                <tr>
                                    <td colspan=\"6\" class=\"text-center py-5\">
                                        <i class=\"fas fa-map-marker-alt fs-1 text-muted mb-3 d-block\"></i>
                                        <h6 class=\"text-muted\">Aucune zone polluée trouvée</h6>
                                        <p class=\"text-muted small mb-0\">Cliquez sur \"Nouvelle Zone\" pour ajouter votre première zone</p>
                                    </td>
                                </tr>
                                ";
        }
        // line 169
        yield "                            </tbody>
                        </table>
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
        return "zone_polluee/index.html.twig";
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
        return array (  327 => 169,  317 => 161,  314 => 160,  299 => 151,  295 => 150,  289 => 147,  283 => 144,  274 => 138,  268 => 135,  264 => 134,  259 => 132,  255 => 131,  252 => 130,  247 => 129,  245 => 128,  220 => 106,  213 => 102,  202 => 94,  183 => 78,  161 => 59,  138 => 39,  124 => 28,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Gestion des Zones Polluées{% endblock %}

{% block body %}
<div class=\"container-fluid py-4\">
    <div class=\"row\">
        <div class=\"col-12\">
            <!-- Breadcrumb -->
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\">
                        <a href=\"#\" class=\"text-decoration-none\">Dashboard</a>
                    </li>
                    <li class=\"breadcrumb-item active\">Zones Polluées</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class=\"d-flex justify-content-between align-items-center mb-4\">
                <h2 class=\"h3 mb-0\">Gestion des Zones Polluées</h2>
            </div>

            <!-- STATS CARDS -->
            <div class=\"row g-3 mb-4\">
                <!-- Nouvelle Zone -->
                <div class=\"col-md-4\">
                    <a href=\"{{ path('app_zone_polluee_new') }}\" class=\"text-decoration-none\">
                        <div class=\"card border-0 shadow-sm h-100\">
                            <div class=\"card-body\">
                                <div class=\"d-flex align-items-center\">
                                    <div class=\"flex-shrink-0\">
                                        <div class=\"bg-primary bg-opacity-10 p-3 rounded-3\">
                                            <i class=\"fas fa-plus-circle text-primary fs-3\"></i>
                                        </div>
                                    </div>
                                    <div class=\"flex-grow-1 ms-3\">
                                        <h6 class=\"text-muted mb-1\">Nouvelle Zone</h6>
                                        <h3 class=\"mb-0 fw-bold\">{{ nouvelles_zones|default(0) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Total Zones -->
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm h-100\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-info bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-map-marker-alt text-info fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total Zones</h6>
                                    <h3 class=\"mb-0 fw-bold\">{{ total_zones|default(0) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Haut Risque -->
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm h-100\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-danger bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-exclamation-triangle text-danger fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Haut Risque</h6>
                                    <h3 class=\"mb-0 fw-bold text-danger\">{{ haut_risque|default(0) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <div class=\"d-flex flex-wrap align-items-center justify-content-between\">
                        <div>
                            <h5 class=\"mb-1\">Liste des Zones Polluées</h5>
                            <p class=\"text-muted small mb-0\">Gérez et surveillez les zones à risque environnemental</p>
                        </div>
                        <a href=\"{{ path('app_zone_polluee_new') }}\" class=\"btn btn-primary mt-2 mt-sm-0\">
                            <i class=\"fas fa-plus me-2\"></i>Nouvelle Zone
                        </a>
                    </div>
                </div>
                
                <div class=\"card-body p-4\">
                    <!-- Search and Filter -->
                    <form method=\"get\" action=\"{{ path('app_zone_polluee_index') }}\" class=\"d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4\">
                        <div class=\"d-flex gap-2\">
                            <div class=\"position-relative\">
                                <i class=\"fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary\"></i>
                                <input type=\"text\" name=\"search\" class=\"form-control ps-5\" style=\"width: 250px;\" placeholder=\"Rechercher une zone...\" value=\"{{ search|default('') }}\">
                            </div>
                            <button type=\"submit\" class=\"btn btn-light\">
                                <i class=\"fas fa-filter me-2\"></i>Filtrer
                            </button>
                        </div>
                    </form>

                    <!-- Table with DELETE BUTTON -->
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover align-middle\">
                            <thead class=\"table-light\">
                                <tr>
                                    <th>Zone</th>
                                    <th>Localisation</th>
                                    <th>Niveau de risque</th>
                                    <th>Date d'identification</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% if zones is defined and zones|length > 0 %}
                                    {% for zone in zones %}
                                    <tr>
                                        <td>{{ zone.nomZone }}</td>
                                        <td>{{ zone.coordonneesGps }}</td>
                                        <td>
                                            <span class=\"badge bg-{{ zone.niveauPollution <= 3 ? 'success' : (zone.niveauPollution <= 6 ? 'warning' : 'danger') }}\">
                                                {{ zone.niveauPollution }}/10
                                            </span>
                                        </td>
                                        <td>{{ zone.dateIdentification|date('d/m/Y') }}</td>
                                        <td>
                                            <span class=\"badge bg-success\">Actif</span>
                                        </td>
                                        <td>
                                            <div class=\"d-flex gap-2\">
                                                <a href=\"{{ path('app_zone_polluee_show', {'id': zone.id}) }}\" class=\"btn btn-sm btn-light\">
                                                    <i class=\"fas fa-eye\"></i>
                                                </a>
                                                <a href=\"{{ path('app_zone_polluee_edit', {'id': zone.id}) }}\" class=\"btn btn-sm btn-light\">
                                                    <i class=\"fas fa-edit\"></i>
                                                </a>
                                                <form method=\"post\" action=\"{{ path('app_zone_polluee_delete', {'id': zone.id}) }}\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cette zone ?');\" style=\"display: inline-block;\">
                                                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ zone.id) }}\">
                                                    <button type=\"submit\" class=\"btn btn-sm btn-light text-danger\">
                                                        <i class=\"fas fa-trash\"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    {% endfor %}
                                {% else %}
                                <tr>
                                    <td colspan=\"6\" class=\"text-center py-5\">
                                        <i class=\"fas fa-map-marker-alt fs-1 text-muted mb-3 d-block\"></i>
                                        <h6 class=\"text-muted\">Aucune zone polluée trouvée</h6>
                                        <p class=\"text-muted small mb-0\">Cliquez sur \"Nouvelle Zone\" pour ajouter votre première zone</p>
                                    </td>
                                </tr>
                                {% endif %}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}", "zone_polluee/index.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\zone_polluee\\index.html.twig");
    }
}

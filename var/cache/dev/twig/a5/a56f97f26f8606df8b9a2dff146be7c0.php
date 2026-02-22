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

/* indicateur_impact/index.html.twig */
class __TwigTemplate_3d3905fa31957774181870e3b668da9b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "indicateur_impact/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "indicateur_impact/index.html.twig"));

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

        yield "Liste des Indicateurs d'Impact";
        
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
        yield "<div class=\"d-flex\">
    <!-- Sidebar -->
    <div class=\"sidebar\">
        <div class=\"sidebar-header\">
            <h3>
                <i class=\"fas fa-recycle me-2\"></i>
                WasteWise
            </h3>
        </div>
        
        <div class=\"sidebar-menu\">
            <div class=\"menu-label\">MAIN</div>
            
            <a href=\"";
        // line 19
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"nav-link\">
                <i class=\"fas fa-chart-pie\"></i>
                <span>Dashboard</span>
            </a>
            
            <a href=\"";
        // line 24
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_index");
        yield "\" class=\"nav-link\">
                <i class=\"fas fa-map-marker-alt\"></i>
                <span>Zones Polluées</span>
            </a>
            
            <a href=\"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_index");
        yield "\" class=\"nav-link active\">
                <i class=\"fas fa-chart-line\"></i>
                <span>Indicateurs d'Impact</span>
            </a>
        </div>
        
        <div class=\"sidebar-footer\">
            <div class=\"d-flex align-items-center\">
                <i class=\"fas fa-circle text-success me-2\" style=\"font-size: 10px;\"></i>
                <span class=\"small\">Admin</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class=\"w-100\">
        <!-- Top Header -->
        <div class=\"top-header d-flex justify-content-between align-items-center\">
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb mb-0\">
                    <li class=\"breadcrumb-item\"><a href=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"text-decoration-none\">Dashboard</a></li>
                    <li class=\"breadcrumb-item active\">Indicateurs</li>
                </ol>
            </nav>
            
            <div class=\"d-flex align-items-center gap-3\">
                <i class=\"fas fa-bell text-muted\"></i>
                <i class=\"fas fa-user-circle text-muted\" style=\"font-size: 1.5rem;\"></i>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class=\"main-content\">
            <!-- Page Header -->
            <div class=\"d-flex justify-content-between align-items-center mb-4\">
                <h2 class=\"h3 mb-0\">Indicateurs d'Impact</h2>
                <a href=\"";
        // line 65
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_new");
        yield "\" class=\"btn btn-green\">
                    <i class=\"fas fa-plus me-2\"></i>Ajouter
                </a>
            </div>

            <!-- Flash Messages -->
            ";
        // line 71
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 71, $this->source); })()), "flashes", ["success"], "method", false, false, false, 71));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 72
            yield "                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                    ";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 77
        yield "
            <!-- Stats Cards -->
            <div class=\"row g-3 mb-4\">
                <div class=\"col-md-4\">
                    <div class=\"stat-card\">
                        <div class=\"d-flex align-items-center\">
                            <div class=\"stat-icon me-3\">
                                <i class=\"fas fa-chart-line fs-3\"></i>
                            </div>
                            <div>
                                <h6 class=\"text-muted mb-1\">Total</h6>
                                <h3 class=\"mb-0 fw-bold\">";
        // line 88
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 88, $this->source); })())), "html", null, true);
        yield "</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"stat-card\">
                        <div class=\"d-flex align-items-center\">
                            <div class=\"stat-icon me-3\">
                                <i class=\"fas fa-trash-alt fs-3\"></i>
                            </div>
                            <div>
                                <h6 class=\"text-muted mb-1\">Déchets (kg)</h6>
                                <h3 class=\"mb-0 fw-bold\">";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::reduce($this->env, (isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 102, $this->source); })()), function ($__total__, $__item__) use ($context, $macros) { $context["total"] = $__total__; $context["item"] = $__item__; return ((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 102, $this->source); })()) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 102, $this->source); })()), "totalKgRecoltes", [], "any", false, false, false, 102)); }, 0), "html", null, true);
        yield " kg</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"stat-card\">
                        <div class=\"d-flex align-items-center\">
                            <div class=\"stat-icon me-3\">
                                <i class=\"fas fa-cloud fs-3\"></i>
                            </div>
                            <div>
                                <h6 class=\"text-muted mb-1\">CO2 évité</h6>
                                <h3 class=\"mb-0 fw-bold\">";
        // line 116
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::reduce($this->env, (isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 116, $this->source); })()), function ($__total__, $__item__) use ($context, $macros) { $context["total"] = $__total__; $context["item"] = $__item__; return ((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 116, $this->source); })()) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 116, $this->source); })()), "co2Evite", [], "any", false, false, false, 116)); }, 0), "html", null, true);
        yield " kg</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class=\"big-card\">
                <div class=\"table-responsive\">
                    <table class=\"table table-hover align-middle\">
                        <thead class=\"table-light\">
                            <tr>
                                <th>ID</th>
                                <th>Déchets (kg)</th>
                                <th>CO2 évité (kg)</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
        // line 137
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 137, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["indicateur"]) {
            // line 138
            yield "                            <tr>
                                <td>#";
            // line 139
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 139), "html", null, true);
            yield "</td>
                                <td>";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "totalKgRecoltes", [], "any", false, false, false, 140), "html", null, true);
            yield " kg</td>
                                <td>";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "co2Evite", [], "any", false, false, false, 141), "html", null, true);
            yield " kg</td>
                                <td>";
            // line 142
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "dateCalcul", [], "any", false, false, false, 142), "d/m/Y H:i"), "html", null, true);
            yield "</td>
                                <td>
                                    <div class=\"d-flex gap-2\">
                                        <a href=\"";
            // line 145
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 145)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-custom\">
                                            <i class=\"fas fa-eye\"></i>
                                        </a>
                                        <a href=\"";
            // line 148
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 148)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-custom\">
                                            <i class=\"fas fa-edit\"></i>
                                        </a>
                                        <form method=\"post\" action=\"";
            // line 151
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 151)]), "html", null, true);
            yield "\" style=\"display:inline;\">
                                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 152
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 152))), "html", null, true);
            yield "\">
                                            <button type=\"submit\" class=\"btn btn-sm btn-outline-custom text-danger\" onclick=\"return confirm('Supprimer ?')\">
                                                <i class=\"fas fa-trash\"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 160
        if (!$context['_iterated']) {
            // line 161
            yield "                            <tr>
                                <td colspan=\"5\" class=\"text-center py-5\">
                                    <i class=\"fas fa-chart-line fs-1 text-muted mb-3\"></i>
                                    <p class=\"text-muted\">Aucun indicateur</p>
                                </td>
                            </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['indicateur'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 168
        yield "                        </tbody>
                    </table>
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
        return "indicateur_impact/index.html.twig";
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
        return array (  339 => 168,  327 => 161,  325 => 160,  312 => 152,  308 => 151,  302 => 148,  296 => 145,  290 => 142,  286 => 141,  282 => 140,  278 => 139,  275 => 138,  270 => 137,  246 => 116,  229 => 102,  212 => 88,  199 => 77,  189 => 73,  186 => 72,  182 => 71,  173 => 65,  154 => 49,  131 => 29,  123 => 24,  115 => 19,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Liste des Indicateurs d'Impact{% endblock %}

{% block body %}
<div class=\"d-flex\">
    <!-- Sidebar -->
    <div class=\"sidebar\">
        <div class=\"sidebar-header\">
            <h3>
                <i class=\"fas fa-recycle me-2\"></i>
                WasteWise
            </h3>
        </div>
        
        <div class=\"sidebar-menu\">
            <div class=\"menu-label\">MAIN</div>
            
            <a href=\"{{ path('admin_dashboard') }}\" class=\"nav-link\">
                <i class=\"fas fa-chart-pie\"></i>
                <span>Dashboard</span>
            </a>
            
            <a href=\"{{ path('app_zone_polluee_index') }}\" class=\"nav-link\">
                <i class=\"fas fa-map-marker-alt\"></i>
                <span>Zones Polluées</span>
            </a>
            
            <a href=\"{{ path('app_indicateur_impact_index') }}\" class=\"nav-link active\">
                <i class=\"fas fa-chart-line\"></i>
                <span>Indicateurs d'Impact</span>
            </a>
        </div>
        
        <div class=\"sidebar-footer\">
            <div class=\"d-flex align-items-center\">
                <i class=\"fas fa-circle text-success me-2\" style=\"font-size: 10px;\"></i>
                <span class=\"small\">Admin</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class=\"w-100\">
        <!-- Top Header -->
        <div class=\"top-header d-flex justify-content-between align-items-center\">
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb mb-0\">
                    <li class=\"breadcrumb-item\"><a href=\"{{ path('admin_dashboard') }}\" class=\"text-decoration-none\">Dashboard</a></li>
                    <li class=\"breadcrumb-item active\">Indicateurs</li>
                </ol>
            </nav>
            
            <div class=\"d-flex align-items-center gap-3\">
                <i class=\"fas fa-bell text-muted\"></i>
                <i class=\"fas fa-user-circle text-muted\" style=\"font-size: 1.5rem;\"></i>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class=\"main-content\">
            <!-- Page Header -->
            <div class=\"d-flex justify-content-between align-items-center mb-4\">
                <h2 class=\"h3 mb-0\">Indicateurs d'Impact</h2>
                <a href=\"{{ path('app_indicateur_impact_new') }}\" class=\"btn btn-green\">
                    <i class=\"fas fa-plus me-2\"></i>Ajouter
                </a>
            </div>

            <!-- Flash Messages -->
            {% for message in app.flashes('success') %}
                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                    {{ message }}
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                </div>
            {% endfor %}

            <!-- Stats Cards -->
            <div class=\"row g-3 mb-4\">
                <div class=\"col-md-4\">
                    <div class=\"stat-card\">
                        <div class=\"d-flex align-items-center\">
                            <div class=\"stat-icon me-3\">
                                <i class=\"fas fa-chart-line fs-3\"></i>
                            </div>
                            <div>
                                <h6 class=\"text-muted mb-1\">Total</h6>
                                <h3 class=\"mb-0 fw-bold\">{{ indicateurs|length }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"stat-card\">
                        <div class=\"d-flex align-items-center\">
                            <div class=\"stat-icon me-3\">
                                <i class=\"fas fa-trash-alt fs-3\"></i>
                            </div>
                            <div>
                                <h6 class=\"text-muted mb-1\">Déchets (kg)</h6>
                                <h3 class=\"mb-0 fw-bold\">{{ indicateurs|reduce((total, item) => total + item.totalKgRecoltes, 0) }} kg</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"stat-card\">
                        <div class=\"d-flex align-items-center\">
                            <div class=\"stat-icon me-3\">
                                <i class=\"fas fa-cloud fs-3\"></i>
                            </div>
                            <div>
                                <h6 class=\"text-muted mb-1\">CO2 évité</h6>
                                <h3 class=\"mb-0 fw-bold\">{{ indicateurs|reduce((total, item) => total + item.co2Evite, 0) }} kg</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class=\"big-card\">
                <div class=\"table-responsive\">
                    <table class=\"table table-hover align-middle\">
                        <thead class=\"table-light\">
                            <tr>
                                <th>ID</th>
                                <th>Déchets (kg)</th>
                                <th>CO2 évité (kg)</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for indicateur in indicateurs %}
                            <tr>
                                <td>#{{ indicateur.id }}</td>
                                <td>{{ indicateur.totalKgRecoltes }} kg</td>
                                <td>{{ indicateur.co2Evite }} kg</td>
                                <td>{{ indicateur.dateCalcul|date('d/m/Y H:i') }}</td>
                                <td>
                                    <div class=\"d-flex gap-2\">
                                        <a href=\"{{ path('app_indicateur_impact_show', {'id': indicateur.id}) }}\" class=\"btn btn-sm btn-outline-custom\">
                                            <i class=\"fas fa-eye\"></i>
                                        </a>
                                        <a href=\"{{ path('app_indicateur_impact_edit', {'id': indicateur.id}) }}\" class=\"btn btn-sm btn-outline-custom\">
                                            <i class=\"fas fa-edit\"></i>
                                        </a>
                                        <form method=\"post\" action=\"{{ path('app_indicateur_impact_delete', {'id': indicateur.id}) }}\" style=\"display:inline;\">
                                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ indicateur.id) }}\">
                                            <button type=\"submit\" class=\"btn btn-sm btn-outline-custom text-danger\" onclick=\"return confirm('Supprimer ?')\">
                                                <i class=\"fas fa-trash\"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {% else %}
                            <tr>
                                <td colspan=\"5\" class=\"text-center py-5\">
                                    <i class=\"fas fa-chart-line fs-1 text-muted mb-3\"></i>
                                    <p class=\"text-muted\">Aucun indicateur</p>
                                </td>
                            </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}", "indicateur_impact/index.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\indicateur_impact\\index.html.twig");
    }
}

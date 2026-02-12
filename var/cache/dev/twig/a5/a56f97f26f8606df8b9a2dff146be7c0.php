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
        yield "<div class=\"container-fluid py-4\">
    <div class=\"row\">
        <div class=\"col-12\">
            <!-- Breadcrumb -->
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\"><a href=\"#\" class=\"text-decoration-none\">Dashboard</a></li>
                    <li class=\"breadcrumb-item active\">Indicateurs d'Impact</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class=\"d-flex justify-content-between align-items-center mb-4\">
                <h2 class=\"h3 mb-0\">Indicateurs d'Impact</h2>
                <a href=\"";
        // line 20
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_new");
        yield "\" class=\"btn btn-primary\">
                    <i class=\"fas fa-plus me-2\"></i>Ajouter un indicateur
                </a>
            </div>

            <!-- Flash Messages -->
            ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "flashes", ["success"], "method", false, false, false, 26));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 27
            yield "                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                    <i class=\"fas fa-check-circle me-2\"></i>";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        yield "
            <!-- Stats Cards -->
            <div class=\"row g-3 mb-4\">
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-primary bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-chart-line text-primary fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total Indicateurs</h6>
                                    <h3 class=\"mb-0 fw-bold\">";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 46, $this->source); })())), "html", null, true);
        yield "</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-success bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-trash-alt text-success fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total Déchets (kg)</h6>
                                    <h3 class=\"mb-0 fw-bold\">
                                        ";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::reduce($this->env, (isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 65, $this->source); })()), function ($__total__, $__item__) use ($context, $macros) { $context["total"] = $__total__; $context["item"] = $__item__; return ((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 65, $this->source); })()) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 65, $this->source); })()), "totalKgRecoltes", [], "any", false, false, false, 65)); }, 0), "html", null, true);
        yield " kg
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-info bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-cloud text-info fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total CO2 évité (kg)</h6>
                                    <h3 class=\"mb-0 fw-bold\">
                                        ";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::reduce($this->env, (isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 85, $this->source); })()), function ($__total__, $__item__) use ($context, $macros) { $context["total"] = $__total__; $context["item"] = $__item__; return ((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 85, $this->source); })()) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 85, $this->source); })()), "co2Evite", [], "any", false, false, false, 85)); }, 0), "html", null, true);
        yield " kg
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <h5 class=\"mb-0\">Liste des indicateurs</h5>
                </div>
                
                <div class=\"card-body p-4\">
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover align-middle\">
                            <thead class=\"table-light\">
                                <tr>
                                    <th>ID</th>
                                    <th>Déchets récoltés (kg)</th>
                                    <th>CO2 évité (kg)</th>
                                    <th>Date de calcul</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ";
        // line 113
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 113, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["indicateur"]) {
            // line 114
            yield "                                <tr>
                                    <td><span class=\"fw-medium\">#";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 115), "html", null, true);
            yield "</span></td>
                                    <td>";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "totalKgRecoltes", [], "any", false, false, false, 116), "html", null, true);
            yield " kg</td>
                                    <td>";
            // line 117
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "co2Evite", [], "any", false, false, false, 117), "html", null, true);
            yield " kg</td>
                                    <td>";
            // line 118
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "dateCalcul", [], "any", false, false, false, 118), "d/m/Y H:i"), "html", null, true);
            yield "</td>
                                    <td>
                                        <div class=\"d-flex gap-2\">
                                            <a href=\"";
            // line 121
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 121)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-light\">
                                                <i class=\"fas fa-eye\"></i>
                                            </a>
                                            <a href=\"";
            // line 124
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 124)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-light\">
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                            <form method=\"post\" action=\"";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 127)]), "html", null, true);
            yield "\" style=\"display:inline;\">
                                                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 128
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 128))), "html", null, true);
            yield "\">
                                                <button type=\"submit\" class=\"btn btn-sm btn-light text-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet indicateur ?')\">
                                                    <i class=\"fas fa-trash\"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                ";
            $context['_iterated'] = true;
        }
        // line 136
        if (!$context['_iterated']) {
            // line 137
            yield "                                <tr>
                                    <td colspan=\"5\" class=\"text-center py-5\">
                                        <i class=\"fas fa-chart-line fs-1 text-muted mb-3 d-block\"></i>
                                        <h6 class=\"text-muted\">Aucun indicateur d'impact enregistré</h6>
                                        <p class=\"text-muted small mb-0\">Cliquez sur \"Ajouter un indicateur\" pour commencer</p>
                                    </td>
                                </tr>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['indicateur'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 145
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
        return array (  304 => 145,  291 => 137,  289 => 136,  276 => 128,  272 => 127,  266 => 124,  260 => 121,  254 => 118,  250 => 117,  246 => 116,  242 => 115,  239 => 114,  234 => 113,  203 => 85,  180 => 65,  158 => 46,  142 => 32,  132 => 28,  129 => 27,  125 => 26,  116 => 20,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Liste des Indicateurs d'Impact{% endblock %}

{% block body %}
<div class=\"container-fluid py-4\">
    <div class=\"row\">
        <div class=\"col-12\">
            <!-- Breadcrumb -->
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\"><a href=\"#\" class=\"text-decoration-none\">Dashboard</a></li>
                    <li class=\"breadcrumb-item active\">Indicateurs d'Impact</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class=\"d-flex justify-content-between align-items-center mb-4\">
                <h2 class=\"h3 mb-0\">Indicateurs d'Impact</h2>
                <a href=\"{{ path('app_indicateur_impact_new') }}\" class=\"btn btn-primary\">
                    <i class=\"fas fa-plus me-2\"></i>Ajouter un indicateur
                </a>
            </div>

            <!-- Flash Messages -->
            {% for message in app.flashes('success') %}
                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                    <i class=\"fas fa-check-circle me-2\"></i>{{ message }}
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                </div>
            {% endfor %}

            <!-- Stats Cards -->
            <div class=\"row g-3 mb-4\">
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-primary bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-chart-line text-primary fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total Indicateurs</h6>
                                    <h3 class=\"mb-0 fw-bold\">{{ indicateurs|length }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-success bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-trash-alt text-success fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total Déchets (kg)</h6>
                                    <h3 class=\"mb-0 fw-bold\">
                                        {{ indicateurs|reduce((total, item) => total + item.totalKgRecoltes, 0) }} kg
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=\"col-md-4\">
                    <div class=\"card border-0 shadow-sm\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"flex-shrink-0\">
                                    <div class=\"bg-info bg-opacity-10 p-3 rounded-3\">
                                        <i class=\"fas fa-cloud text-info fs-3\"></i>
                                    </div>
                                </div>
                                <div class=\"flex-grow-1 ms-3\">
                                    <h6 class=\"text-muted mb-1\">Total CO2 évité (kg)</h6>
                                    <h3 class=\"mb-0 fw-bold\">
                                        {{ indicateurs|reduce((total, item) => total + item.co2Evite, 0) }} kg
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class=\"card border-0 shadow-sm\">
                <div class=\"card-header bg-white border-0 pt-4 px-4\">
                    <h5 class=\"mb-0\">Liste des indicateurs</h5>
                </div>
                
                <div class=\"card-body p-4\">
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover align-middle\">
                            <thead class=\"table-light\">
                                <tr>
                                    <th>ID</th>
                                    <th>Déchets récoltés (kg)</th>
                                    <th>CO2 évité (kg)</th>
                                    <th>Date de calcul</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for indicateur in indicateurs %}
                                <tr>
                                    <td><span class=\"fw-medium\">#{{ indicateur.id }}</span></td>
                                    <td>{{ indicateur.totalKgRecoltes }} kg</td>
                                    <td>{{ indicateur.co2Evite }} kg</td>
                                    <td>{{ indicateur.dateCalcul|date('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class=\"d-flex gap-2\">
                                            <a href=\"{{ path('app_indicateur_impact_show', {'id': indicateur.id}) }}\" class=\"btn btn-sm btn-light\">
                                                <i class=\"fas fa-eye\"></i>
                                            </a>
                                            <a href=\"{{ path('app_indicateur_impact_edit', {'id': indicateur.id}) }}\" class=\"btn btn-sm btn-light\">
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                            <form method=\"post\" action=\"{{ path('app_indicateur_impact_delete', {'id': indicateur.id}) }}\" style=\"display:inline;\">
                                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ indicateur.id) }}\">
                                                <button type=\"submit\" class=\"btn btn-sm btn-light text-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet indicateur ?')\">
                                                    <i class=\"fas fa-trash\"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                {% else %}
                                <tr>
                                    <td colspan=\"5\" class=\"text-center py-5\">
                                        <i class=\"fas fa-chart-line fs-1 text-muted mb-3 d-block\"></i>
                                        <h6 class=\"text-muted\">Aucun indicateur d'impact enregistré</h6>
                                        <p class=\"text-muted small mb-0\">Cliquez sur \"Ajouter un indicateur\" pour commencer</p>
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
</div>
{% endblock %}", "indicateur_impact/index.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\indicateur_impact\\index.html.twig");
    }
}

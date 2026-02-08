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
        yield "<div class=\"container mt-5\">
    <h1>Indicateurs d'Impact</h1>
    
    <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_new");
        yield "\" class=\"btn btn-success mb-3\">Ajouter un indicateur</a>
    
    ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 11, $this->source); })()), "flashes", ["success"], "method", false, false, false, 11));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 12
            yield "        <div class=\"alert alert-success\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        yield "    
    <table class=\"table table-striped\">
        <thead>
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
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["indicateurs"]) || array_key_exists("indicateurs", $context) ? $context["indicateurs"] : (function () { throw new RuntimeError('Variable "indicateurs" does not exist.', 26, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["indicateur"]) {
            // line 27
            yield "            <tr>
                <td>";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 28), "html", null, true);
            yield "</td>
                <td>";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "totalKgRecoltes", [], "any", false, false, false, 29), "html", null, true);
            yield "</td>
                <td>";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "co2Evite", [], "any", false, false, false, 30), "html", null, true);
            yield "</td>
                <td>";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "dateCalcul", [], "any", false, false, false, 31), "d/m/Y H:i"), "html", null, true);
            yield "</td>
                <td>
                    <a href=\"";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 33)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-info\">Voir</a>
                    <a href=\"";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 34)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-warning\">Modifier</a>
                    <form method=\"post\" action=\"";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 35)]), "html", null, true);
            yield "\" style=\"display:inline;\">
                        <input type=\"hidden\" name=\"_token\" value=\"";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["indicateur"], "id", [], "any", false, false, false, 36))), "html", null, true);
            yield "\">
                        <button type=\"submit\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet indicateur ?')\">Supprimer</button>
                    </form>
                </td>
            </tr>
            ";
            $context['_iterated'] = true;
        }
        // line 41
        if (!$context['_iterated']) {
            // line 42
            yield "            <tr>
                <td colspan=\"5\" class=\"text-center\">Aucun indicateur d'impact enregistré</td>
            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['indicateur'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        yield "        </tbody>
    </table>
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
        return array (  195 => 46,  186 => 42,  184 => 41,  174 => 36,  170 => 35,  166 => 34,  162 => 33,  157 => 31,  153 => 30,  149 => 29,  145 => 28,  142 => 27,  137 => 26,  123 => 14,  114 => 12,  110 => 11,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Liste des Indicateurs d'Impact{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <h1>Indicateurs d'Impact</h1>
    
    <a href=\"{{ path('app_indicateur_impact_new') }}\" class=\"btn btn-success mb-3\">Ajouter un indicateur</a>
    
    {% for message in app.flashes('success') %}
        <div class=\"alert alert-success\">{{ message }}</div>
    {% endfor %}
    
    <table class=\"table table-striped\">
        <thead>
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
                <td>{{ indicateur.id }}</td>
                <td>{{ indicateur.totalKgRecoltes }}</td>
                <td>{{ indicateur.co2Evite }}</td>
                <td>{{ indicateur.dateCalcul|date('d/m/Y H:i') }}</td>
                <td>
                    <a href=\"{{ path('app_indicateur_impact_show', {'id': indicateur.id}) }}\" class=\"btn btn-sm btn-info\">Voir</a>
                    <a href=\"{{ path('app_indicateur_impact_edit', {'id': indicateur.id}) }}\" class=\"btn btn-sm btn-warning\">Modifier</a>
                    <form method=\"post\" action=\"{{ path('app_indicateur_impact_delete', {'id': indicateur.id}) }}\" style=\"display:inline;\">
                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ indicateur.id) }}\">
                        <button type=\"submit\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet indicateur ?')\">Supprimer</button>
                    </form>
                </td>
            </tr>
            {% else %}
            <tr>
                <td colspan=\"5\" class=\"text-center\">Aucun indicateur d'impact enregistré</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
</div>
{% endblock %}", "indicateur_impact/index.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\indicateur_impact\\index.html.twig");
    }
}

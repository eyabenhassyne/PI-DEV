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
        yield "<div class=\"container mt-5\">
    <h1>Indicateur d'Impact #";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 7, $this->source); })()), "id", [], "any", false, false, false, 7), "html", null, true);
        yield "</h1>
    
    <div class=\"card\">
        <div class=\"card-body\">
            <p><strong>Total de déchets récoltés :</strong> ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 11, $this->source); })()), "totalKgRecoltes", [], "any", false, false, false, 11), "html", null, true);
        yield " kg</p>
            <p><strong>CO2 évité :</strong> ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 12, $this->source); })()), "co2Evite", [], "any", false, false, false, 12), "html", null, true);
        yield " kg</p>
            <p><strong>Date de calcul :</strong> ";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 13, $this->source); })()), "dateCalcul", [], "any", false, false, false, 13), "d/m/Y à H:i"), "html", null, true);
        yield "</p>
            
            <hr>
            
            ";
        // line 17
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 17, $this->source); })()), "zonePollues", [], "any", false, false, false, 17))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 18
            yield "                <p><strong>Zones polluées associées :</strong></p>
                <ul>
                    ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 20, $this->source); })()), "zonePollues", [], "any", false, false, false, 20));
            foreach ($context['_seq'] as $context["_key"] => $context["zone"]) {
                // line 21
                yield "                        <li>
                            <a href=\"";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "id", [], "any", false, false, false, 22)]), "html", null, true);
                yield "\">
                                ";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "nomZone", [], "any", false, false, false, 23), "html", null, true);
                yield " (Pollution: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["zone"], "niveauPollution", [], "any", false, false, false, 23), "html", null, true);
                yield "/10)
                            </a>
                        </li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['zone'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            yield "                </ul>
            ";
        } else {
            // line 29
            yield "                <p class=\"text-muted\">Aucune zone polluée associée à cet indicateur</p>
            ";
        }
        // line 31
        yield "        </div>
    </div>
    
    <a href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_index");
        yield "\" class=\"btn btn-secondary mt-3\">Retour</a>
    <a href=\"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_indicateur_impact_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["indicateur"]) || array_key_exists("indicateur", $context) ? $context["indicateur"] : (function () { throw new RuntimeError('Variable "indicateur" does not exist.', 35, $this->source); })()), "id", [], "any", false, false, false, 35)]), "html", null, true);
        yield "\" class=\"btn btn-warning mt-3\">Modifier</a>
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
        return array (  171 => 35,  167 => 34,  162 => 31,  158 => 29,  154 => 27,  142 => 23,  138 => 22,  135 => 21,  131 => 20,  127 => 18,  125 => 17,  118 => 13,  114 => 12,  110 => 11,  103 => 7,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Détails de l'indicateur{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <h1>Indicateur d'Impact #{{ indicateur.id }}</h1>
    
    <div class=\"card\">
        <div class=\"card-body\">
            <p><strong>Total de déchets récoltés :</strong> {{ indicateur.totalKgRecoltes }} kg</p>
            <p><strong>CO2 évité :</strong> {{ indicateur.co2Evite }} kg</p>
            <p><strong>Date de calcul :</strong> {{ indicateur.dateCalcul|date('d/m/Y à H:i') }}</p>
            
            <hr>
            
            {% if indicateur.zonePollues is not empty %}
                <p><strong>Zones polluées associées :</strong></p>
                <ul>
                    {% for zone in indicateur.zonePollues %}
                        <li>
                            <a href=\"{{ path('app_zone_polluee_show', {'id': zone.id}) }}\">
                                {{ zone.nomZone }} (Pollution: {{ zone.niveauPollution }}/10)
                            </a>
                        </li>
                    {% endfor %}
                </ul>
            {% else %}
                <p class=\"text-muted\">Aucune zone polluée associée à cet indicateur</p>
            {% endif %}
        </div>
    </div>
    
    <a href=\"{{ path('app_indicateur_impact_index') }}\" class=\"btn btn-secondary mt-3\">Retour</a>
    <a href=\"{{ path('app_indicateur_impact_edit', {'id': indicateur.id}) }}\" class=\"btn btn-warning mt-3\">Modifier</a>
</div>
{% endblock %}", "indicateur_impact/show.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\indicateur_impact\\show.html.twig");
    }
}

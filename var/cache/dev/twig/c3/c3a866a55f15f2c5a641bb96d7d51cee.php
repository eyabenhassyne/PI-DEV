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
        yield "<div class=\"container mt-5\">
    <h1>";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 7, $this->source); })()), "nomZone", [], "any", false, false, false, 7), "html", null, true);
        yield "</h1>
    
    <div class=\"card\">
        <div class=\"card-body\">
            <p><strong>Coordonnées GPS :</strong> ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 11, $this->source); })()), "coordonneesGps", [], "any", false, false, false, 11), "html", null, true);
        yield "</p>
            <p><strong>Niveau de pollution :</strong> 
                <span class=\"badge 
                    ";
        // line 14
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 14, $this->source); })()), "niveauPollution", [], "any", false, false, false, 14) <= 3)) {
            yield "bg-success
                    ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 15
(isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 15, $this->source); })()), "niveauPollution", [], "any", false, false, false, 15) <= 6)) {
            yield "bg-warning
                    ";
        } else {
            // line 16
            yield "bg-danger";
        }
        yield "\">
                    ";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 17, $this->source); })()), "niveauPollution", [], "any", false, false, false, 17), "html", null, true);
        yield "/10
                </span>
            </p>
            
            ";
        // line 21
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 21, $this->source); })()), "indicateur", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 22
            yield "                <p><strong>Indicateur associé :</strong></p>
                <ul>
                    <li>Déchets récoltés : ";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 24, $this->source); })()), "indicateur", [], "any", false, false, false, 24), "totalKgRecoltes", [], "any", false, false, false, 24), "html", null, true);
            yield " kg</li>
                    <li>CO2 évité : ";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 25, $this->source); })()), "indicateur", [], "any", false, false, false, 25), "co2Evite", [], "any", false, false, false, 25), "html", null, true);
            yield " kg</li>
                    <li>Date de calcul : ";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 26, $this->source); })()), "indicateur", [], "any", false, false, false, 26), "dateCalcul", [], "any", false, false, false, 26), "d/m/Y H:i"), "html", null, true);
            yield "</li>
                </ul>
            ";
        }
        // line 29
        yield "        </div>
    </div>
    
    <a href=\"";
        // line 32
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_index");
        yield "\" class=\"btn btn-secondary mt-3\">Retour</a>
    <a href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_zone_polluee_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["zone"]) || array_key_exists("zone", $context) ? $context["zone"] : (function () { throw new RuntimeError('Variable "zone" does not exist.', 33, $this->source); })()), "id", [], "any", false, false, false, 33)]), "html", null, true);
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
        return array (  166 => 33,  162 => 32,  157 => 29,  151 => 26,  147 => 25,  143 => 24,  139 => 22,  137 => 21,  130 => 17,  125 => 16,  120 => 15,  116 => 14,  110 => 11,  103 => 7,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Détails de la zone{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <h1>{{ zone.nomZone }}</h1>
    
    <div class=\"card\">
        <div class=\"card-body\">
            <p><strong>Coordonnées GPS :</strong> {{ zone.coordonneesGps }}</p>
            <p><strong>Niveau de pollution :</strong> 
                <span class=\"badge 
                    {% if zone.niveauPollution <= 3 %}bg-success
                    {% elseif zone.niveauPollution <= 6 %}bg-warning
                    {% else %}bg-danger{% endif %}\">
                    {{ zone.niveauPollution }}/10
                </span>
            </p>
            
            {% if zone.indicateur %}
                <p><strong>Indicateur associé :</strong></p>
                <ul>
                    <li>Déchets récoltés : {{ zone.indicateur.totalKgRecoltes }} kg</li>
                    <li>CO2 évité : {{ zone.indicateur.co2Evite }} kg</li>
                    <li>Date de calcul : {{ zone.indicateur.dateCalcul|date('d/m/Y H:i') }}</li>
                </ul>
            {% endif %}
        </div>
    </div>
    
    <a href=\"{{ path('app_zone_polluee_index') }}\" class=\"btn btn-secondary mt-3\">Retour</a>
    <a href=\"{{ path('app_zone_polluee_edit', {'id': zone.id}) }}\" class=\"btn btn-warning mt-3\">Modifier</a>
</div>
{% endblock %}", "zone_polluee/show.html.twig", "C:\\Users\\Mega-PC\\Desktop\\mon-projet\\templates\\zone_polluee\\show.html.twig");
    }
}

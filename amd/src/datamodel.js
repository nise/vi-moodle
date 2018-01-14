define(['/moodle/mod/videodatabase/amd/src/vfg.js'], function (VueFormGenerator) {
    return function () {
        return {
            "language": "de",
            "version": 1,
            "data": {
                "groups": [
                    {
                        "legend": "Video",
                        "styleClasses":"col-md-4",
                        "fields": [
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Dateiname",
                                "model": "filename",
                                "disabled": true
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Länge",
                                "model": "length",
                                "disabled": true
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Dateigröße",
                                "model": "size",
                                "disabled": true
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Videoformat",
                                "model": "format",
                                "disabled": true
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Mime",
                                "model": "mimetype",
                                "disabled": true
                            }
                        ]
                    },
                    {
                        "legend": "Allgemeines",
                        "styleClasses": "col-md-12",
                        "fields": [
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Titel",
                                "model": "title",
                                "featured": true,
                                "required": true,
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Beschreibung",
                                "model": "description",
                                "featured": true,
                                "required": true,
                                "min": 4,
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Schlüsselwörter",
                                "model": "tags",
                                "featured": true,
                                "required": true,
                                "validator": VueFormGenerator.validators.string
                            }
                        ]
                    },
                   
                    {
                        "legend": "Didaktische Einordnung",
                        "styleClasses": "col-md-12",
                        "fields": [
                            {
                                "model": "sports",
                                "label": "Sportart",
                                "type": "select",
                                "filterable": true,
                                "level": 1,
                                "values": [
                                    "Fußball",
                                    "Handball",
                                    "Barren",
                                    "Judo",
                                    "Handball",
                                    "Volleyball"
                                ]
                            },
                            {
                                "model": "movements",
                                "label": "Bewegungsfelder",
                                "type": "select",
                                "multi": false,
                                "filterable": true,
                                "level": 1,
                                "values": [
                                    "Laufen, Springen, Werfen, Stoßen",
                                    "Spiele",
                                    "Bewegung an Geräten",
                                    "Kämpfen nach Regeln",
                                    "Bewegungsfolgen gestalten und darstellen",
                                    "Bewegen im Wasser",
                                    "Fahren, Rollen, Gleiten"
                                ]
                            },
                            {
                                "model": "courselevel",
                                "label": "Lerngruppe",
                                "type": "checklist",
                                "multi": true,
                                "filterable": true,
                                "level": 1,
                                "values": [
                                    "Eingangsstufe",
                                    "Unterstufe",
                                    "Mittelstufe",
                                    "Werkstufe",
                                    "Klassenstufe 1",
                                    "Klassenstufe 2",
                                    "Klassenstufe 3",
                                    "Klassenstufe 4",
                                    "Klassenstufe 5",
                                    "Klassenstufe 6",
                                    "Klassenstufe 7",
                                    "Klassenstufe 8",
                                    "Klassenstufe 9",
                                    "Klassenstufe 10",
                                    "Klassenstufe 11",
                                    "Klassenstufe 12",
                                    "Klassenstufe 13"
                                ]
                            },
                            {
                                "model": "actors",
                                "label": "Akteure",
                                "type": "select",
                                "multi": false,
                                "filterable": true,
                                "level": 2,
                                "values": [
                                    "Lehrer/in",
                                    "Schüler/in"
                                ]
                            },
                            {
                                "model": "location",
                                "label": "Ort",
                                "type": "checklist",
                                "filterable": true,
                                "level": 2,
                                "values": [
                                    "Sporthalle",
                                    "Schwimmhalle",
                                    "Outdoor"
                                ]
                            },
                            {
                                "model": "competencies",
                                "label": "Fachbezogene Kompetenzen",
                                "type": "checklist",
                                "multi": true,
                                "filterable": true,
                                "level": 2,
                                "values": [
                                    "Bewegen und Handeln",
                                    "Reflektieren und Urteilen",
                                    "Interagieren",
                                    "Methoden anwenden"
                                ]
                            },
                            {
                                "model": "activities",
                                "label": "Aktivitäten",
                                "type": "checklist",
                                "multi": true,
                                "filterable": true,
                                "level": 2,
                                "values": [
                                    "Abbauen",
                                    "Aufbauen",
                                    "Begründen",
                                    "Beraten",
                                    "Beschreiben",
                                    "Besprechen",
                                    "Beurteilen",
                                    "Demonstrieren",
                                    "Disziplinieren",
                                    "Erklären",
                                    "Feedback, Korrektur",
                                    "Gesprächsrunde",
                                    "Gruppenbildung",
                                    "Helfen",
                                    "Kooperieren",
                                    "Medieneinsatz",
                                    "Motivieren",
                                    "Organisieren",
                                    "Präsentieren",
                                    "Sichern",
                                    "Störung",
                                    "Üben"
                                ]
                            },
                            {
                                "model": "perspectives",
                                "label": "Päd. Perspektiven",
                                "type": "checklist",
                                listBox: true,
                                "multi": true,
                                "filterable": true,
                                "level": 2,
                                "values": [
                                    "Leistung",
                                    "Wagnis",
                                    "Gestaltung",
                                    "Körpererfahrung",
                                    "Kooperation",
                                    "Gesundheit"
                                ]
                            }
                        ]
                    },
                    {
                        "legend": "Dublin Core Metadaten",
                        "styleClasses": "col-md-12",
                        "fields": [
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Fach",
                                "model": "subject",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Ersteller",
                                "model": "Creator",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Herausgeber",
                                "model": "publisher",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Institution",
                                "model": "institution",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Quelle",
                                "model": "source",
                                "featured": true,
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Sprache",
                                "model": "language",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Lizenz",
                                "model": "license",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Urheberrechte",
                                "model": "rights",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Relation",
                                "model": "relation",
                                "validator": VueFormGenerator.validators.string
                            },
                            {
                                "type": "input",
                                "inputType": "text",
                                "label": "Bereich",
                                "model": "coverage",
                                "validator": VueFormGenerator.validators.string
                            }
                        ]
                    }
                ]
            }
        }
        
    };
});

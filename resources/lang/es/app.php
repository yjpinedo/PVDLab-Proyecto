<?php

return [

    'messages' => [
        'project' => [
            'APROBADO' => 'Proyecto Aprobado',
            'RECHAZADO' => 'Proyecto Rechazado',
            'PENDIENTE' => 'Proyecto Pendiente',
            'update' => 'No se puede aprobar un proyecto RECHAZADO',
        ],
        'apply' => [
            'apply' => 'Se ha Registrado en el curso :name',
            'error' => 'Ya se encuentra registrado en el curso :name'
        ],
        'task_assistance' => [
            'assistance' => 'Se ha tomado la asistencia del alumno :name',
            'error' => 'Ya se encuentra lista el alumno :name'
        ],

    ],

    'buttons' => [
        'apply' => 'Aplicar',
        'download' => 'Descargar',
    ],

    'titles' => [
        'beneficiaries' => 'Beneficiarios',
        'beneficiary' => [
            'courses_lists' => 'Cursos',
            'application_course' => 'Aplicar Curso',
            'courses' => ' Mis Cursos',
            'projects' => 'Mis Proyectos',
            'lessons' => 'Lecciones',
            'members' => 'Integrantes',
        ],
        'beneficiary_courses' => 'Beneficiarios - Cursos',
        'beneficiary_lessons' => 'Beneficiarios - Lecciones',
        'categories' => 'Categorías',
        'configuration' => 'Configuracion',
        'courses' => 'Cursos',
        'employees' => 'Empleados',
        'employee' => [
            'transfers' => 'Transferencias',
            'beneficiaries' => 'Beneficiarios',
            'projects' => 'Proyectos',
        ],
        'furniture' => 'Muebles',
        'furniture_categories' => 'Categorias - Muebles',
        'formats' => 'Formatos',
        'home' => 'Inicio',
        'lessons' => 'Lecciones',
        'locations' => 'Localizaciones',
        'members' => 'Integrantes',
        'positions' => 'Cargos',
        'projects' => 'Proyectos',
        'project_beneficiaries' => 'Proyectos - Beneficios',
        'teachers' => 'Docentes',
        'teacher' => [
            'beneficiaries' => 'Beneficiarios',
            'courses' => 'Cursos',
            'lessons' => 'Lecciones',
        ],
        'transfers' => 'Tranferencias',
        'transfer_furnitures' => 'Tranferencias - Muebles',
    ],

    'sections' => [
        'academic_information' => 'Información Académica',
        'contact_information' => 'Información de Contacto',
        'personal_information' => 'Información Personal',
        'project_information' => 'Información del Proyecto',
        'financing_information' => 'Información de Financiación',
    ],

    'selects' => [
        'course' => [
            'days' => [
                'LUNES' => 'LUNES',
                'MARTES' => 'MARTES',
                'MIERCOLES' => 'MIERCOLES',
                'JUEVES' => 'JUEVES',
                'VIERNES' => 'VIERNES',
                'LUNES_MARTES' => 'LUNES - MARTES',
                'LUNES_MIERCOLES' => 'LUNES - MIERCOLES',
                'LUNES_JUEVES' => 'LUNES - JUEVES',
                'LUNES_VIERNES' => 'LUNES - VIERNES',
                'MARTES_MIERCOLES' => 'MARTES - MIERCOLE',
                'MARTES_JUEVES' => 'MARTES - JUEVES',
                'MARTES_VIERNES' => 'MARTES - VIERNES',
                'MIERCOLES_JUEVES' => 'MIERCOLES - JUEVES',
                'MIERCOLES_VIERNES' => 'MIERCOLES - VIERNES',
                'JUEVES_VIERNES' => 'JUEVES - VIERNES',
            ]
        ],
        'project' => [
            'concept' => [
                'APROBADO' => 'APROBADO',
                'RECHAZADO' => 'RECHAZADO',
                'PENDIENTE' => 'PENDIENTE',
            ],
            'concept_class' => [
                'APROBADO' => 'success',
                'RECHAZADO' => 'danger',
                'PENDIENTE' => 'warning',
            ],
            'concept_next' => [
                'APROBADO' => '',
                'RECHAZADO' => '',
                'PENDIENTE' => 'APROBADO',
            ],
            'financing' => [
                'SI' => 'SI',
                'NO' => 'NO',
                'FINANCIACIÓN PROPIA' => 'FINANCIACIÓN PROPIA',
            ],
            'state' => [
                'SIN INICIAR' => 'SIN INICIAR',
                'EN EJECUCIÓN' => 'EN EJECUCIÓN',
                'TERMINADO' => 'TERMINADO',
            ],
            'origin' => [
                'PROYECTO DE GRADO' => 'PROYECTO DE GRADO',
                'CONVOCATORIA APP.CO' => 'CONVOCATORIA APP.CO',
                'CONVOCATORIA EXTERNA' => 'CONVOCATORIA EXTERNA',
                'CONVOCATORIA INTERNA' => 'CONVOCATORIA INTERNA',
                'OTRO' => 'OTRO',
            ],
            'type' => [
                'APLICACIÓN WEB O MÓVIL' => 'APLICACIÓN WEB O MÓVIL',
                'SOFTWARE' => 'SOFTWARE',
                'PRODUCCIÓN AUDIOVISUAL' => 'PRODUCCIÓN AUDIOVISUAL',
                'PRODUCCIÓN MUSICAL' => 'PRODUCCIÓN MUSICAL',
                'OTRO' => 'OTRO',
            ],
        ],
        'teacher' => [
            'title_type' => [
                'TÉCNICO' => 'TÉCNICO',
                'TECNÓLOGO' => 'TECNÓLOGO',
                'PROFESIONAL' => 'PROFESIONAL',
                'ESPECIALISTA' => 'ESPECIALISTA',
                'MAESTRÍA' => 'MAESTRÍA',
                'DOCTORADO' => 'DOCTORADO',
            ],
        ],
        'person' => [
            'document_type' => [
                'CÉDULA DE CIUDADANÍA' => 'CÉDULA DE CIUDADANÍA',
                'CÉDULA DE EXTRANJERÍA' => 'CÉDULA DE EXTRANJERÍA',
            ],
            'sex' => [
                'FEMENINO' => 'FEMENINO',
                'MASCULINO' => 'MASCULINO',
            ],
            'ethnic_group' => [
                'PUEBLOS Y COMUNIDADES INDÍGENAS' => 'PUEBLOS Y COMUNIDADES INDÍGENAS',
                'COMUNIDADES NEGRAS O AFROCOLOMBIANAS' => 'COMUNIDADES NEGRAS O AFROCOLOMBIANAS',
                'COMUNIDAD RAIZAL' => 'COMUNIDAD RAIZAL',
                'NO PERTENECE A NINGUNO DE LOS ANTERIORES' => 'NO PERTENECE A NINGUNO DE LOS ANTERIORES',
                'OTROS' => 'OTROS',
            ],
            'stratum' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            ],
        ],
    ],


    'roles' => [
        'admin' => 'Administrador',
        'beneficiaries' => 'Beneficiarios',
        'teachers' => 'Docentes',
        'employees' => 'Empleados',
    ],
];

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
            'not_assistance' => 'Se ha cancelado la asistencia del alumno :name',
            'error' => 'Ya se encuentra lista el alumno :name'
        ],
        'loan' => [
            'APROBADO' => 'Préstamo Aprobado',
            'RECHAZADO' => 'Préstamo Rechazado',
            'PENDIENTE' => 'Préstamo Pendiente',
            'update' => 'No se puede aprobar un préstamo RECHAZADO',
            'validate_quantity' => 'Artículos insuficientes - (:quantity) artículos disponibles.',
            'validate_loans' => 'El beneficiario :name no ha realizado solcitudes de présamos.',
        ],
        'users' => [
            'assign' => 'Rol asignado con éxito',
            'error' => 'No se asignó el rol con éxito'
        ],
    ],

    'buttons' => [
        'apply' => 'Aplicar',
        'download' => 'Descargar',
        'assign_role' => 'Asignar Rol',
    ],

    'titles' => [
        'articles' => 'Artículos',
        'article' => 'Artículo',
        'articles_warehouses' => 'Lista de almacenes',
        'beneficiaries' => 'Beneficiarios',
        'beneficiary' => [
            'courses_lists' => 'Cursos Disponibles',
            'courses_admin' => ':name - Cursos',
            'application_course' => 'Aplicar Curso',
            'courses' => ' Mis Cursos',
            'projects' => 'Mis Proyectos',
            'lessons' => 'Lecciones',
            'loan' => [
                'articles' => 'Artículos asociados al préstamo',
                'list_loans' => 'Lista de préstamos',
            ],
            'loans' => 'Solicitud de Préstamos',
            'members' => 'Integrantes',
            'update-password' => 'Actualizar contraseña',
            'profile' => 'Mi Perfil',
        ],
        'beneficiary_courses' => 'Beneficiarios - Cursos',
        'beneficiary_lessons' => 'Beneficiarios - Lecciones',
        'courses_lessons' => 'Cursos - Lecciones',
        'categories' => 'Categorías',
        'configuration' => 'Configuracion',
        'courses' => 'Cursos',
        'dashboard' => 'Estadísticas',
        'dashboards' => [
            'users' => 'Usuarios',
            'projects' => 'Proyectos',
            'courses' => 'Cursos',
            'loans' => 'Préstamos',
        ],
        'employees' => 'Empleados',
        'employee' => [
            'articles' => 'Artículos',
            'beneficiaries' => 'Beneficiarios',
            'courses' => 'Cursos',
            'dashboards' => [
                'users' => 'Usuarios',
                'projects' => 'Proyectos',
                'courses' => 'Cursos',
                'loans' => 'Préstamos',
            ],
            'formats' => 'Formatos',
            'loans' => 'loans',
            'movements' => 'Movimientos',
            'profile' => 'Mi Perfil',
            'projects' => 'Proyectos',
            'teachers' => 'Docentes',
            'update-password' => 'Actualizar contraseña',
            'warehouses' => 'Almacén',
            'warehouses_articles' => 'Artículos',
        ],
        'formats' => 'Formatos',
        'home' => 'Inicio',
        'lessons' => 'Lecciones',
        'loans' => 'Préstamos',
        'loans_articles' => 'Lista de Artículos',
        'members' => 'Integrantes',
        'profile' => 'Configuración',
        'positions' => 'Cargos',
        'projects' => 'Proyectos',
        'project_beneficiaries' => 'Proyectos - Beneficios',
        'teachers' => 'Docentes',
        'teacher' => [
            'beneficiaries' => 'Beneficiarios',
            'courses' => 'Cursos',
            'lessons' => 'Lecciones',
            'profile' => 'Mi Perfil',
            'update-password' => 'Actualizar contraseña',
        ],
        'users' => 'Asignar rol',
        'movements' => 'Movimientos',
        'warehouses' => 'Almacén',
        'warehouses_articles' => 'Almacén - Artículos'
    ],

    'sections' => [
        'academic_information' => 'Información Académica',
        'contact_information' => 'Información de Contacto',
        'personal_information' => 'Información Personal',
        'project_information' => 'Información del Proyecto',
        'financing_information' => 'Información de Financiación',
        'article_information' => 'Información del Artículo',
        'warehouse_information' => 'Información del Almacén',
    ],

    'selects' => [
        'state' => [
            'ACTIVO' => 'ACTIVO',
            'INACTIVO' => 'INACTIVO',
        ],
        'lesson' => [
            'assistance' => [
                'ASISTIO' => 'ASISTIÓ',
                'FALLO' => 'FALLÓ',
            ],
            'assistance_class' => [
                'ASISTIO' => 'success',
                'FALLO' => 'danger',
            ],
            'assistance_next' => [
                'ASISTIO' => '',
                'FALLO' => 'ASISTIO',
            ],
        ],
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
            ],
            'state' => [
                'DISPONIBLE' => 'DISPONIBLE',
                'CERRADO' => 'CERRADO',
            ],
            'progress' => [
                'INSCRITO' => 'INSCRITO',
                'FINALIZADO' => 'FINALIZADO',
                'PROCESO' => 'PROCESO',
            ],
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
        'movement' =>
        [
            'type' => [
                'ENTRADA' => 'ENTRADA',
                'SALIDA' => 'SALIDA',
                'TRASPASO' => 'TRASPASO',
                'BLOQUEO' => 'BLOQUEO',
                'DESBLOQUEAR' => 'DESBLOQUEAR',
                'RESERVA' => 'RESERVA',
                'RESERVA FICTICIA' => 'RESERVA FICTICIA',
                'FABRICACIÓN' => 'FABRICACIÓN',
                'FABRICACIÓN FICTICIA' => 'FABRICACIÓN FICTICIA',
                'REGULARIZACIÓN' => 'REGULACIÓN',
                'LIBERACIÓN' => 'LIBERACIÓN',
            ],
        ],
        'loans' => [
            'state' => [
                'APROBADO' => 'APROBADO',
                'RECHAZADO' => 'RECHAZADO',
                'PENDIENTE' => 'PENDIENTE',
            ],
            'state_class' => [
                'APROBADO' => 'success',
                'RECHAZADO' => 'danger',
                'PENDIENTE' => 'warning',
            ],
            'state_next' => [
                'APROBADO' => '',
                'RECHAZADO' => '',
                'PENDIENTE' => 'APROBADO',
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

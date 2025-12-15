// src/data.js

// src/data.js

export const voyages = [
    { 
        id: 1, 
        title: 'Torii Miyajima', 
        duration: 6, 
        price: 950, 
        imageUrl: '/public/img/torii-Miyajima.jpeg', 
        options: 'Culturel', 
        theme: 'Temple', 
        distance_km: 75,
        mapImageUrl: '/public/img/miyajima_map.jpg',
        timeline_steps: [
            { day: 1, label: 'Arrivée et transfert à Miyajima' },
            { day: 2, label: 'Visite du sanctuaire d\'Itsukushima' },
            { day: 3, label: 'Mont Misen et observation' },
            { day: 4, label: 'Journée libre et départ' }
        ]
    },
    { 
        id: 2, 
        title: 'Shirakawa-go', 
        duration: 5, 
        price: 620, 
        imageUrl: '/public/img/shirakawa_go.jpg', 
        options: 'Nature', 
        theme: 'Montagne', 
        distance_km: 150,
         mapImageUrl: '/public/img/shirakawa-go.jpg',
        timeline_steps: [
            { day: 1, label: 'Arrivée dans la vallée' },
            { day: 2, label: 'Randonnée dans la forêt de cèdres' },
            { day: 3, label: 'Visite des maisons traditionnelles gasshō-zukuri' },
            { day: 4, label: 'Découverte des traditions locales' },
            { day: 5, label: 'Départ' }
        ]
    },
    { 
        id: 3, 
        title: 'Chute de Nachi', 
        duration: 5, 
        price: 620, 
        imageUrl: '/public/img/Chute2nachi.webp',  
        options: 'Nature', 
        theme: 'Temple', 
        distance_km: 40,
        mapImageUrl: '/public/img/nachi_map.webp',
        timeline_steps: [
            { day: 1, label: 'Arrivée à Nachi Katsuura' },
            { day: 2, label: 'Marche vers les Chutes de Nachi' },
            { day: 3, label: 'Visite du Seiganto-ji' },
            { day: 4, label: 'Randonnée dans la région de Kumano' }
        ]
    },
    { 
        id: 4, 
        title: 'Nara', 
        duration: 7, 
        price: 1100, 
        imageUrl: '/public/img/nara.jpg',  
        options: 'Culturel', 
        theme: 'Temple', 
        distance_km: 120,
         mapImageUrl: '/public/img/nara-map.png',
        timeline_steps: [
            { day: 1, label: 'Arrivée à Nara' },
            { day: 2, label: 'Visite du parc de Nara et des daims' },
            { day: 3, label: 'Temple Tōdai-ji et sanctuaire Kasuga' },
            { day: 4, label: 'Exploration des quartiers historiques' }
        ]
    },
    { 
        id: 5, 
        title: 'Miyako-jima', 
        duration: 5, 
        price: 920, 
        imageUrl: '/public/img/miyako-jima.jpg',  
        options: 'Nature', 
        theme: 'Plage', 
        distance_km: 800,
        mapImageUrl: '/public/img/miyako-jima-map.png',
        timeline_steps: [
            { day: 1, label: 'Arrivée à Miyako-jima (île)' },
            { day: 2, label: 'Détente sur la plage de Maehama' },
            { day: 3, label: 'Exploration sous-marine et snorkeling' },
            { day: 4, label: 'Visite du phare de Higashi-Hennazaki' }
        ]
    },
    { 
        id: 6, 
        title: 'Shirakawa-go', 
        duration: 5, 
        price: 620, 
        imageUrl: '/public/img/Shirakawa-go2.jpeg', 
        options: 'Nature', 
        theme: 'Montagne', 
        distance_km: 160,
        mapImageUrl: '/public/img/shirakawa-go.jpg',
        timeline_steps: [
            { day: 1, label: 'Arrivée et accueil' },
            { day: 2, label: 'Randonnée et nature' },
            { day: 3, label: 'Immersion culturelle' }
        ]
    },
    { 
        id: 7, 
        title: 'Taikodani Inari-jinja', 
        duration: 7, 
        price: 1100, 
        imageUrl: '/public/img/Taikodani-inari-jinja.jpg',
        options: 'Culturel', 
        theme: 'Temple', 
        distance_km: 50,
        mapImageUrl: '/public/img/taikodani-inari.webp',
        timeline_steps: [
            { day: 1, label: 'Arrivée et découverte de Tsuwano' },
            { day: 2, label: 'Ascension du Taikodani Inari-jinja' },
            { day: 3, label: 'Journée dans la ville historique' }
        ]
    },
    { 
        id: 8, 
        title: 'Kumejima', 
        duration: 7, 
        price: 630, 
        imageUrl: '/public/img/kumejima.jpg',
        options: 'Nature', 
        theme: 'Plage', 
        distance_km: 130,
        mapImageUrl: '/public/img/kumejima-map.jpg',
        timeline_steps: [
            { day: 1, label: 'Arrivée sur l\'île' },
            { day: 2, label: 'Plage de Hateno-hama' },
            { day: 3, label: 'Exploration de l\'île et randonnée' },
            { day: 4, label: 'Découverte des fonds marins' }
        ]
    },
    // Si vous ajoutez Osaka :
    /*
    { 
        id: 9, 
        title: 'Osaka', 
        duration: 3, 
        price: 850, 
        imageUrl: '/public/img/osaka.jpg',  
        options: 'Culturel', 
        theme: 'Ville', 
        distance_km: 0, 
        timeline_steps: [
            { day: 1, label: 'Universal Studio - Jour 1' },
            { day: 2, label: 'Jour 2 - Balade au cœur de Osaka' },
            { day: 3, label: 'Musée Toyotomi Ishigaki - Jour 3' }
        ]
    },
    */
];
interface NavItem {
    href: string;
    label: string;
    active: boolean;
}

export const getNavItem = (): NavItem[] => {
    return [
        {
            href: '/dashboard',
            label: 'Dashboard',
            active: route().current('dashboard.index'),
        },
        {
            href: '/dashboard/kegiatan',
            label: 'Kegiatan',
            active: route().current('dashboard.kegiatan.index'),
        },
        {
            href: '/dashboard/proyek',
            label: 'Proyek',
            active: route().current('dashboard.proyek.index'),
        },
        {
            href: '/dashboard/sektor',
            label: 'Sektor',
            active: route().current('dashboard.sektor.index'),
        },
        {
            href: '/dashboard/laporan',
            label: 'Laporan',
            active: route().current('dashboard.laporan.index'),
        },
        {
            href: '/dashboard/mitra',
            label: 'Mitra',
            active: route().current('dashboard.mitra.index'),
        },
    ];
};

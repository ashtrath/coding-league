export interface User {
    id: string;
    full_name?: string;
    email: string;
    email_verified_at?: string;
    image?: string;
    role: 'Admin' | 'Mitra';
}

export interface Mitra {
    id: string;
    user_id: string;
    name_mitra?: string;
    name_company: string;
    phone_number?: string;
    address?: string;
    status: 'Active' | 'Inactive';
}

export interface Sektor {
    id: string;
    image?: string;
    name: string;
    description?: string;
}

export interface Analytics {
    total_project: number;
    total_project_terealisasi: number;
    total_anggaran_realisasi: number;
    total_mitra: number;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    mitras: Mitra[];
    sektors: Sektor[];
    analytics: Analytics;
};

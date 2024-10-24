import { BreadcrumbItem } from '@/Components/UI/Breadcrumbs';

export interface User {
    id: string;
    full_name?: string;
    email: string;
    email_verified_at?: string;
    image?: string;
    role: 'Admin' | 'Mitra';
}

export interface Analytics {
    total_project: number;
    total_project_terealisasi: number;
    total_anggaran_realisasi: number;
    total_mitra: number;
}

export interface Pagination {
    total: number;
    per_page: number;
    current_page: number;
    last_page: number;
    from: number;
    to: number;
    next_page_url: string | null;
    prev_page_url: string | null;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth?: {
        user: User;
    };
    breadcrumbs?: BreadcrumbItem[];
};

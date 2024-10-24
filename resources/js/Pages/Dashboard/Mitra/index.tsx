import MitraDataTable from '@/Components/DataTable/MitraDataTable';
import Button from '@/Components/UI/Button';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { PageProps, Pagination, User } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { RiAddLine } from '@remixicon/react';

export interface Mitra {
    id: string;
    image?: string;
    name_mitra?: string;
    name_company: string;
    phone_number?: string;
    address?: string;
    status: 'Active' | 'Inactive';
    created_at: Date;
    updated_at?: Date;
    user: User;
}

const DashboardMitra = ({
    data,
    pagination,
}: PageProps<{ data: Mitra[]; pagination: Pagination }>) => {
    return (
        <DashboardLayout>
            <Head title="Mitra" />

            <header className="flex items-baseline justify-between">
                <h2 className="text-[28px] font-semibold leading-[44px] text-gray-900">
                    Mitra
                </h2>
                <Button size="lg" asChild>
                    <Link
                        href={route('dashboard.mitra.create')}
                        className="gap-2"
                    >
                        <RiAddLine className="size-5" />
                        Buat Mitra Baru
                    </Link>
                </Button>
            </header>
            <MitraDataTable data={data} pagination={pagination} />
        </DashboardLayout>
    );
};

export default DashboardMitra;

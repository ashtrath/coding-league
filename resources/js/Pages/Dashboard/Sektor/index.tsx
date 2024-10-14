import SektorDataTable from '@/Components/DataTable/Sektor/SektorDataTable';
import Button from '@/Components/UI/Button';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { PageProps, Sektor } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { RiAddLine } from '@remixicon/react';

const DashboardSektor = ({ data, pagination }: PageProps<Sektor[]>) => {
    return (
        <DashboardLayout>
            <Head title="Sektor" />

            <header className="flex items-baseline justify-between">
                <h2 className="text-[28px] font-semibold leading-[44px] text-gray-900">
                    Sektor
                </h2>
                <Button size="lg" asChild>
                    <Link
                        href={route('dashboard.sektor.create')}
                        className="gap-2"
                    >
                        <RiAddLine className="size-5" />
                        Buat Sektor Baru
                    </Link>
                </Button>
            </header>
            <div className="container mx-auto">
                <SektorDataTable data={data} pagination={pagination} />
            </div>
        </DashboardLayout>
    );
};

export default DashboardSektor;

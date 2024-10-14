import Button from '@/Components/UI/Button';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { PageProps } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { RiAddLine } from '@remixicon/react';

const ShowSektor = ({ sektors }: PageProps) => {
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
            <div className="container mx-auto">Disini ada Table</div>
        </DashboardLayout>
    );
};

export default ShowSektor;

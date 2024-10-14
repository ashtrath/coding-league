import EditSektorForm from '@/Components/Form/EditSektorForm';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { PageProps } from '@/types';
import { Head } from '@inertiajs/react';

const EditSektor = ({ data }: PageProps) => {
    return (
        <DashboardLayout>
            <Head title="Ubah Data Sektor" />

            <header className="flex items-baseline justify-between">
                <h2 className="text-[28px] font-semibold leading-[44px] text-gray-900">
                    Ubah Data Sektor
                </h2>
            </header>
            <EditSektorForm initialData={data} />
        </DashboardLayout>
    );
};

export default EditSektor;

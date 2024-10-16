import ProgramDataTable from '@/Components/DataTable/Sektor/ProgramDataTable';
import Breadcrumbs from '@/Components/UI/Breadcrumbs';
import Button from '@/Components/UI/Button';
import Footer from '@/Components/UI/Footer';
import Navbar from '@/Components/UI/Navbar';
import { type PageProps } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { RiPencilLine } from '@remixicon/react';
import { Sektor } from '.';

interface SektorDetail extends Sektor {
    projects: {
        id: string;
        title: string;
        description: string;
    };
}
const ShowSektor = ({ data }: PageProps<{ data: SektorDetail }>) => {
    return (
        <>
            <Head title="Sektor" />
            <main className="min-h-[calc(100vh_-_93px)]">
                <Navbar />

                <header className="relative mt-[93px] flex h-[500px] flex-col justify-between px-24 py-[52px] pb-20 text-white before:absolute before:inset-0 before:z-[-5] before:bg-gray-900/60">
                    <div className="flex items-center justify-between">
                        <Breadcrumbs color="text-white" />
                        <Button size="lg" asChild>
                            <Link
                                href={route('dashboard.sektor.edit', data.id)}
                                className="gap-2"
                            >
                                <RiPencilLine className="size-6" /> Ubah Sektor
                            </Link>
                        </Button>
                    </div>
                    <div className="space-y-2">
                        <h1 className="text-4xl font-semibold tracking-tight">
                            {data.name}
                        </h1>
                        {data.description && (
                            <p className="text-2xl">{data.description}</p>
                        )}
                    </div>
                    <img
                        className="absolute inset-0 z-[-10] size-full object-cover"
                        src={`/storage/${data.image}`}
                        alt={`Gambar Sektor ${data.name}`}
                    />
                </header>
                <section className="min-w-full space-y-6 overflow-hidden bg-gray-100 px-24 py-[60px]">
                    <h2 className="text-[28px] font-semibold tracking-tight text-gray-900">
                        Program
                    </h2>
                    <ProgramDataTable data={data.projects} />
                </section>
            </main>
            <Footer />
        </>
    );
};

export default ShowSektor;
